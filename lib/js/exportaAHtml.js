/**
 * Permite que los eventos de html usen la función.
 * @param {function} functionInstance
 */
export function exportaAHtml(functionInstance) {
 window[nombreDeFuncionParaHtml(functionInstance)] = functionInstance
}

/**
 * @param {function} valor
 */
export function nombreDeFuncionParaHtml(valor) {
 const names = valor.name.split(/\s+/g)
 return names[names.length - 1]
}