<!-- Este es un ejamplo de una vista de blade 
se carga al inicio las provincias y luego se pide mediante
AJAX (Jquery) las localidades según la provincia selecionada -->

<?php



?>

<form action="" method="post">
    <!-- -------------- Selector de provincias -->
    <select name="provincias" id="provincias">
        <option disabled selected>Selecciona Provincia</option>
        @foreach ($provincias as $provincia)
        <option value="{{$provincia->nombre}}">{{$provincia->nombre}}</option>
        @endforeach
    </select>

    <!-- ------------------ Selector de Localidades -->
    <select name="localidades" id="localidades">
        
    </select>

</form>

<script type="text/javascript">
window.onload = function(){
    $("#localidades").hide();
    $("#provincias").change(function(){
        $.ajax({        
            // le pido a la url '/utils/provincia' el liostado de loclaidades
            url: "/utils/" + $(this).val(),
            method: 'GET',
            success: function(data) {
                $('#localidades').html(data.html+"<option value='Otro'>Otro</option>");    
                $("#localidades").show();            
            }
        });
    });
}
</script>
    


