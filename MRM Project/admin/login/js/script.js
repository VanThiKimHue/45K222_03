function autoCalcSetup(){
	$('form[name=submit]').jAutoCalc({
		  // default attribute
  attribute: 'jAutoCalc',

  // thousand separator
  thousandOpts: [''],

  // decimal separator
  decimalOpts: ['.'],

  // decimal places
  decimalPlaces: 1,

  // do the math right away?
  initFire: true,

  // allows chained calculation?
  chainFire: true,

  // do the math everytime keys are pressed
  keyEventsFire: true,

  // are the results read-only?
  readOnlyResults: true,

  // shows parse error
  showParseError: true,

  // treats empty as zero
  emptyAsZero: true,

  // smart intergers?
  smartIntegers: true,

  // callback
  onShowResult: null,

  // custom functions
  funcs: {},

  // custom constants
  vars: {
  }
	});
    
}
autoCalcSetup();