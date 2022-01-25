const ingresar = () => {
    var username = document.getElementById('txt_uname').value;
    var password = document.getElementById('txt_pwd').value;

    //window.alert(`usuario ${username} + password: ${password}`)
    $.ajax({
        url: 'pages/checkUser.php',
        type: 'post',
        data: {
            username,
            password
        },
        success: (response) => {
            if (response == 1) {
                window.location = "pages/empleadosphp/modulo_bienestar.php";
                window.alert("BIENESTAR");
            } else if (response == 2) {
                //window.location = "pages/empleadosphp/modulo_parrilla.php";
                window.alert("NUTRICION");
            } else if (response == 3) {
                //window.location = "pages/empleadosphp/modulo_parrilla.php";
                window.alert("SALUD");
            } else {
                window.alert("nombre o contraseña inválida");
                return;
            }
        }
    });

}

const modal_empleado_nuevo = () => {
    $('#modal_nuevo_empleado').modal('show');
}

const modal_grupo_familiar = () => {
    $('#modal_grupo_familiar').modal('show');
}

const Ingresar_Empleado = () => {

    var rut = document.getElementById('emple_rut').value;
    var nombres = document.getElementById('emple_nombres').value;
    var ap_paterno = document.getElementById('emple_appaterno').value;
    var ap_materno = document.getElementById('emple_apmaterno').value;
    var fecha_nac = document.getElementById('emple_fnac').value;
    var nacionalidad = document.getElementById('emple_nacionalidad').value;
    var sexo = document.getElementById('emple_sexo').value;
    var est_civil = document.getElementById('emple_estciv').value;
    var cargo = document.getElementById('emple_cargo').value;
    var fecha_ing = document.getElementById('emple_fing').value;
    var correo = document.getElementById('emple_correo').value;
    var telefono = document.getElementById('emple_telefono').value;
    var tipo_contrato = document.getElementById('emple_tcontra').value;
    var contacto_emergencia = document.getElementById('emple_emergencia').value;
    var titulo = document.getElementById('emple_titulo').value;
    var nivel_estudios = document.getElementById('emple_nvlestu').value;
    var fecha_matrimonio = document.getElementById('emple_fmatri').value;
    var enfermedad_cronica = document.getElementById('emple_enfercro').value;
    var rsh = document.getElementById('emple_rsh').value;
    var tratamiento = document.getElementById('emple_tratam').value;
    var discapacidad = document.getElementById('emple_discap').value;
    var tipo_discapacidad = document.getElementById('emple_tipdisca').value;
    var prog_interv = document.getElementById('emple_progint').value;
    var estado = document.getElementById('emple_estado').value;
    var id_empleado = document.getElementById('emple_id_empleado').value;


    if (rut == "") {
        alert('Debe ingresar Rut');
        return;
    } else {
        if (nombres == "") {
            alert('Debe ingresar Nombres');
            return;
        } else {
            if (ap_paterno == "") {
                alert('Debe ingresar Apellido Paterno');
                return;
            } else {
                if (ap_materno == "") {
                    alert('Debe ingresar Apellido Materno');
                    return;
                } else {
                    if (fecha_nac == "") {
                        alert('Debe ingresar Fecha de Nacimiento');
                        return;
                    } else {
                        if (estado == "") {
                            alert('Debe ingresar Estado');
                            return;
                        } else {
                            if (id_empleado > 0) {
                                if (confirm('Desea Editar Trabajador?')) {
                                    $.ajax({
                                        url: 'ingresar_trabajador.php',
                                        type: 'post',
                                        data: {
                                            rut,
                                            nombres,
                                            ap_paterno,
                                            ap_materno,
                                            fecha_nac,
                                            nacionalidad,
                                            sexo,
                                            est_civil,
                                            cargo,
                                            fecha_ing,
                                            correo,
                                            telefono,
                                            tipo_contrato,
                                            contacto_emergencia,
                                            titulo,
                                            nivel_estudios,
                                            fecha_matrimonio,
                                            enfermedad_cronica,
                                            rsh,
                                            tratamiento,
                                            discapacidad,
                                            tipo_discapacidad,
                                            prog_interv,
                                            estado,
                                            id_empleado
                                        },
                                        success: (response) => {
                                            if (response == 1) {
                                                window.alert("Rut ya se encuentra ingresado");
                                                return;
                                            } else if (response == 2) {
                                                window.alert("Trabajador Ingresado");
                                                location.reload();
                                            } else if (response == 3) {
                                                window.alert("Trabajador Editado");
                                                location.reload();
                                            } else {
                                                window.alert("Trabajador Editado");
                                                location.reload();
                                            }
                                        }
                                    });
                                }
                            } else {
                                if (confirm('Desea Ingresar Trabajador?')) {
                                    $.ajax({
                                        url: 'ingresar_trabajador.php',
                                        type: 'post',
                                        data: {
                                            rut,
                                            nombres,
                                            ap_paterno,
                                            ap_materno,
                                            fecha_nac,
                                            nacionalidad,
                                            sexo,
                                            est_civil,
                                            cargo,
                                            fecha_ing,
                                            correo,
                                            telefono,
                                            tipo_contrato,
                                            contacto_emergencia,
                                            titulo,
                                            nivel_estudios,
                                            fecha_matrimonio,
                                            enfermedad_cronica,
                                            rsh,
                                            tratamiento,
                                            discapacidad,
                                            tipo_discapacidad,
                                            prog_interv,
                                            estado,
                                            id_empleado
                                        },
                                        success: (response) => {
                                            if (response == 1) {
                                                window.alert("Rut ya se encuentra ingresado");
                                                return;
                                            } else if (response == 2) {
                                                window.alert("Trabajador Ingresado");
                                                location.reload();
                                            } else if (response == 3) {
                                                window.alert("Trabajador Editado");
                                                location.reload();
                                            } else {
                                                window.alert("Trabajador Ingresado");
                                                location.reload();
                                            }
                                        }
                                    });
                                }
                            }
                        }
                    }
                }
            }
        }
    }
}

const editar_trabajador = (id_empleado, rut, nombres, ap_paterno, ap_materno, fecha_nac, nacionalidad, sexo, est_civil, cargo, fecha_ing, correo, telefono, tipo_contrato, contacto_emergencia, titulo, nivel_estudios, fecha_matrimonio, enfermedad_cronica, rsh, tratamiento, discapacidad, tipo_discapacidad, prog_interv, estado) => {
    $('#emple_rut').val(rut);
    $('#emple_nombres').val(nombres);
    $('#emple_appaterno').val(ap_paterno);
    $('#emple_apmaterno').val(ap_materno);
    $('#emple_fnac').val(fecha_nac);
    $('#emple_nacionalidad').val(nacionalidad);
    $('#emple_estciv').val(est_civil);
    $('#emple_cargo').val(cargo);
    $('#emple_sexo').val(sexo);
    $('#emple_fing').val(fecha_ing);
    $('#emple_correo').val(correo);
    $('#emple_telefono').val(telefono);
    $('#emple_tcontra').val(tipo_contrato);
    $('#emple_emergencia').val(contacto_emergencia);
    $('#emple_titulo').val(titulo);
    $('#emple_nvlestu').val(nivel_estudios);
    $('#emple_fmatri').val(fecha_matrimonio);
    $('#emple_enfercro').val(enfermedad_cronica);
    $('#emple_rsh').val(rsh);
    $('#emple_tratam').val(tratamiento);
    $('#emple_discap').val(discapacidad);
    $('#emple_tipdisca').val(tipo_discapacidad);
    $('#emple_progint').val(prog_interv);
    $('#emple_estado').val(estado);
    $('#emple_id_empleado').val(id_empleado);

    $('#modal_nuevo_empleado').modal('show');
}

const agregar_grupof = () => {
    var id_empleado = document.getElementById('gf_id_empleado').value;
    var nombre = document.getElementById('gf_nombre').value;
    var rut = document.getElementById('gf_rut').value;
    var edad = document.getElementById('gf_edad').value;
    var nivel_edu = document.getElementById('gf_nvlestu').value;
    var ocupacion = document.getElementById('gf_ocupacion').value;
    var parentesco = document.getElementById('gf_parentesco').value;
    if (id_empleado == "") {
        alert('Debe ingresar Trabajador');
        return;
    } else {
        if (nombre == "") {
            alert('Debe ingresar Nombre');
            return;
        } else {
            if (rut == "") {
                alert('Debe ingresar Rut');
                return;
            } else {
                if (edad == "") {
                    alert('Debe ingresar Edad');
                    return;
                } else {
                    if (nivel_edu == "") {
                        alert('Debe ingresar Nivel Educacional');
                        return;
                    } else {
                        if (ocupacion == "") {
                            alert('Debe ingresar Ocupación');
                            return;
                        } else {
                            if (parentesco == "") {
                                alert('Debe ingresar Parentesco');
                                return;
                            } else {
                                if (confirm('Desea Ingresar?')) {
                                    $.ajax({
                                        url: 'ingreso_grupo_familiar.php',
                                        type: 'post',
                                        data: {
                                            id_empleado,
                                            nombre,
                                            rut,
                                            edad,
                                            nivel_edu,
                                            ocupacion,
                                            parentesco
                                        },
                                        success: (datos) => {

                                            $.ajax({
                                                url: 'tabla_grupof.php',
                                                type: 'post',
                                                data: {
                                                    id_empleado
                                                },
                                                success: function(datos) {
                                                    $('#tabla_grupof').html(datos);

                                                }
                                            });

                                        }
                                    });
                                }
                            }
                        }
                    }
                }
            }
        }
    }
}


$(document).ready(function() {
    $('#gf_id_empleado').val(1);
    recargarGrupoF();

    $('#gf_id_empleado').change(function() {
        recargarGrupoF();
    });
});

const recargarGrupoF = () => {
    var id_empleado = $('#gf_id_empleado').val();
    $.ajax({
        url: 'tabla_grupof.php',
        type: 'post',
        data: {
            id_empleado
        },
        success: function(datos) {
            $('#tabla_grupof').html(datos);

        }
    });
}

const borrar_gf = (id_empleado, id_grupo) => {
    $.ajax({
        url: 'borrar_gf.php',
        type: 'post',
        data: {
            id_grupo
        },
        success: function() {
            $.ajax({
                url: 'tabla_grupof.php',
                type: 'post',
                data: {
                    id_empleado
                },
                success: function(datos) {
                    $('#tabla_grupof').html(datos);
                }
            });
        }
    });
}

const pdf_bienestar = (id_empleado) => {
    window.open('pdf_bienestar.php?id=' + id_empleado);
};