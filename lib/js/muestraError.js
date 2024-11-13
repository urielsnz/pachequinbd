import { exportaAHtml } from "./exportaAHtml.js"
import { ProblemDetails } from "./ProblemDetails.js"

/**
 * Muestra un error en la consola y en un cuadro de
 * alerta el mensaje de una excepción.
 * @param { ProblemDetails | Error | null } error descripción del error.
 */
export function muestraError(error) {

 if (error === null) {

  console.error("Error")
  alert("Error")

 } else if (error instanceof ProblemDetails) {

  let mensaje = error.title
  if (error.detail) {
   mensaje += `\n\n${error.detail}`
  }
  mensaje += `\n\nCódigo: ${error.status}`
  if (error.type) {
   mensaje += ` ${error.type}`
  }

  console.error(mensaje)
  console.error(error)
  console.error("Headers:")
  error.headers.forEach((valor, llave) => console.error(llave, "=", valor))
  alert(mensaje)

 } else {

  console.error(error)
  alert(error.message)

 }

}

exportaAHtml(muestraError)