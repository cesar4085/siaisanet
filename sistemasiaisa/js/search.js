$(document).ready(function(e){
    $('.search-panel .dropdown-menu').find('a').click(function(e) {
		e.preventDefault();
		var param = $(this).attr("href").replace("#","");
		var concept = $(this).text();
		$('.search-panel span#search_concept').text(concept);
		$('.input-group #search_param').val(param);

		if (concept == 'Clientes')
		{
$('.input-group #x').attr("placeholder","Raul Martinez");
		}
else if (concept =='Número de Cuenta') {

	$('.input-group #x').attr("placeholder","ejemplo: 3001-09056459");
}
	else   {

	$('.input-group #x').attr("placeholder","ejemplo: local(5511-2233), celular(5511-22-3344)");
}	
	})
});


   