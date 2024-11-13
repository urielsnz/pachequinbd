import { exportaAHtml } from "./exportaAHtml.js"
import { ProblemDetails } from "./ProblemDetails.js"

/**
 * Espera a que la promesa de un fetch termine. Si
 * hay error, lanza una excepción. Si no hay error,
 * interpreta la respuesta del servidor como JSON y
 * la convierte en una literal de objeto.
 * 
 * @param { string | Promise<Response> } servicio
 */
export async function consumeJson(servicio) {

 if (typeof servicio === "string") {
  servicio = fetch(servicio, {
   headers: { "Accept": "application/json, application/problem+json" }
  })
 } else if (!(servicio instanceof Promise)) {
  throw new Error("Servicio de especie incorrecto.")
 }

 const respuesta = await servicio

 const headers = respuesta.headers

 if (respuesta.ok) {
  // Aparentemente el servidor tuvo éxito.

  if (respuesta.status === 204) {
   // No contiene texto de respuesta.

   return { headers, body: {} }

  } else {

   const texto = await respuesta.text()

   try {

    return { headers, body: JSON.parse(texto) }

   } catch (error) {

    // El contenido no es JSON. Probablemente sea texto de un error.
    throw new ProblemDetails(respuesta.status, headers, texto,
     "/error/errorinterno.html")

   }

  }

 } else {
  // Hay un error.

  const texto = await respuesta.text()

  if (texto === "") {

   // No hay texto. Se usa el texto predeterminado.
   throw new ProblemDetails(respuesta.status, headers, respuesta.statusText)

  } else {
   // Debiera se un ProblemDetails en JSON.

   try {

    const { title, type, detail } = JSON.parse(texto)

    throw new ProblemDetails(respuesta.status, headers,
     typeof title === "string" ? title : respuesta.statusText,
     typeof type === "string" ? type : undefined,
     typeof detail === "string" ? detail : undefined)

   } catch (error) {

    if (error instanceof ProblemDetails) {
     // El error si era un ProblemDetails

     throw error

    } else {

     throw new ProblemDetails(respuesta.status, headers, respuesta.statusText,
      undefined, texto)

    }

   }

  }

 }

}

exportaAHtml(consumeJson)