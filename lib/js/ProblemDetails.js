/**
 * Detalle de los errores devueltos por un servicio.
 */
export class ProblemDetails extends Error {

 /**
  * @param {number} status
  * @param {Headers} headers
  * @param {string} title
  * @param {string} [type]
  * @param {string} [detail]
  */
 constructor(status, headers, title, type, detail) {
  super(title)
  /**
   * @readonly
   */
  this.status = status
  /**
   * @readonly
   */
  this.headers = headers
  /**
   * @readonly
   */
  this.type = type
  /**
   * @readonly
   */
  this.detail = detail
  /**
   * @readonly
   */
  this.title = title
 }

}