function mueveReloj(){



    btnAdd = document.getElementById("reloj");
    if (btnAdd != null) {

    var dias = ["Domingo", "Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado"];
    var meses = ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"];

    momentoActual = new Date()
    dia = momentoActual.getDate()
    diaSemana = momentoActual.getDay()
    mes = momentoActual.getMonth()
    anho = momentoActual.getFullYear()


    fecha = dias[diaSemana] + " " + dia + " de " + meses[mes] + " de " + anho + " Hora: " + formatoAMPM(momentoActual)
    document.getElementById("reloj").innerHTML = fecha;

    setTimeout("mueveReloj()",1000);

    }

    function formatoAMPM(date) {
        var horas = date.getHours();
        var minutos = date.getMinutes();
        var segundos = date.getSeconds();
        var ampm = horas >= 12 ? 'pm' : 'am';
        horas = horas % 12;
        horas = horas ? horas : 12; // the hour '0' should be '12'
        minutos = minutos < 10 ? '0'+minutos : minutos;
        segundos = segundos < 10 ? '0'+segundos : segundos;
        var hora = horas + ':' + minutos + ':' + segundos + " " + ampm;
        return hora;
    }
}

function recarga(){
    btnAdd = document.getElementById("reloj");
    if (btnAdd != null) {
    //setInterval("location.reload()", 30000);
    }
}
