export default class {

  static getError(errors){
    var allErrors = errors;
    if (typeof(allErrors) == 'object') {
      for (var errorkey in allErrors) {
        if (allErrors[errorkey]){
          return allErrors[errorkey];
        }
      }
    }else{
      return allErrors;
    }
  }

  static verifyFields(data){
    //# Validando campos genericos
      for (const key in data) {
        if(data[key] === null || data[key] === ''){
          return 'Faltan campos por rellenar';
        }
      }
      return false;
  }
}
