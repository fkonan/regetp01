

// properties are directly passed to `create` method
var FormRia = Class.create({
  initialize: function() {
  },
  
  
  /**
  * Agrega eventos onload para que detecte el ENTER y que envie el 
  * formulario (hace un submit)
  **/
  agregarOnEnterPressParaElFormulario: function(idformulario) {
    Event.observe(window, 'load', 
		function() {
			Event.observe(document, 'keypress', 
				function (event){
					if (Event.KEY_RETURN == event.keyCode) {
						$(idformulario).submit();
					}
				return;
				}
			);
		}
	);	
  }
  
  
  
});
