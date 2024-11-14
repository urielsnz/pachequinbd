import { exportaAHtml } from "./exportaAHtml.js"

/**
 * @param { Document | HTMLElement } raizHtml
 * @param { any } objeto
 */
export function muestraObjeto(raizHtml, objeto) {

 for (const [nombre, definiciones] of Object.entries(objeto)) {

  if (Array.isArray(definiciones)) {

   muestraArray(raizHtml, nombre, definiciones)

  } else if (definiciones !== undefined && definiciones !== null) {

   const elementoHtml = buscaElementoHtml(raizHtml, nombre)

   if (elementoHtml instanceof HTMLInputElement) {

    muestraInput(raizHtml, elementoHtml, definiciones)

   } else if (elementoHtml !== null) {

    for (const [atributo, valor] of Object.entries(definiciones)) {
     if (atributo in elementoHtml) {
      elementoHtml[atributo] = valor
     }
    }

   }

  }

 }

}
exportaAHtml(muestraObjeto)

/**
 * @param { Document | HTMLElement } raizHtml
 * @param { string } nombre
 */
export function buscaElementoHtml(raizHtml, nombre) {
 return raizHtml.querySelector(
  `#${nombre},[name="${nombre}"],[data-name="${nombre}"]`)
}

/**
 * @param { Document | HTMLElement } raizHtml
 * @param { string } propiedad
 * @param {any[]} valores
 */
function muestraArray(raizHtml, propiedad, valores) {

 const conjunto = new Set(valores)
 const elementos =
  raizHtml.querySelectorAll(`[name="${propiedad}"],[data-name="${propiedad}"]`)

 if (elementos.length === 1) {
  const elemento = elementos[0]

  if (elemento instanceof HTMLSelectElement) {
   const options = elemento.options
   for (let i = 0, len = options.length; i < len; i++) {
    const option = options[i]
    option.selected = conjunto.has(option.value)
   }
   return
  }

 }

 for (let i = 0, len = elementos.length; i < len; i++) {
  const elemento = elementos[i]
  if (elemento instanceof HTMLInputElement) {
   elemento.checked = conjunto.has(elemento.value)
  }
 }

}

/**
 * @param { Document | HTMLElement } raizHtml
 * @param { HTMLInputElement } input
 * @param { any } definiciones
 */
function muestraInput(raizHtml, input, definiciones) {

 for (const [atributo, valor] of Object.entries(definiciones)) {

  if (atributo == "data-file") {

   const img = getImgParaElementoHtml(raizHtml, input)
   if (img !== null) {
    input.dataset.file = valor
    input.value = ""
    if (valor === "") {
     img.src = ""
     img.hidden = true
    } else {
     img.src = valor
     img.hidden = false
    }
   }

  } else if (atributo in input) {

   input[atributo] = valor

  }
 }

}

/**
 * @param { Document | HTMLElement } raizHtml
 * @param { HTMLElement } elementoHtml
 */
export function getImgParaElementoHtml(raizHtml, elementoHtml) {
 const imgId = elementoHtml.getAttribute("data-img")
 if (imgId === null) {
  return null
 } else {
  const input = buscaElementoHtml(raizHtml, imgId)
  if (input instanceof HTMLImageElement) {
   return input
  } else {
   return null
  }
 }
}