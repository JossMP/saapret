$(function () {
    $(document).on('change', ':file', function () {
        var input = $(this),
            numFiles = input.get(0).files ? input.get(0).files.length : 1,
            label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
        // Vista Previa
        target = input.data("target");
        if (target) {
            var reader = new FileReader();
            reader.onload = function (file) {
                var fileContent = file.target.result;
                $("#" + target).attr("src", fileContent);
            }
            reader.readAsDataURL(this.files[0]);
        }
        input.trigger('fileselect', [numFiles, label]);
        var input = $(this).siblings('.custom-file-label');
        var log = numFiles > 1 ? numFiles + ' archivos seleccionados' : label;
        if (input.length) {
            input.text(log);
        } else {
            if (log) console.log(log);
        }
    });
});

// Validatios BT4
(function () {
    'use strict';
    window.addEventListener('load', function () {
        // Fetch all the forms we want to apply custom Bootstrap validation styles to
        var forms = document.getElementsByClassName('needs-validation');
        // Loop over them and prevent submission
        var validation = Array.prototype.filter.call(forms, function (form) {
            form.addEventListener('submit', function (event) {
                if (form.checkValidity() === false) {
                    event.preventDefault();
                    event.stopPropagation();
                }
                form.classList.add('was-validated');
            }, false);
        });
    }, false);
})();

/*** AJAX ACTION | EVENT CLICK ***/
$(function () {
    $_reset = function (form) {
        $(":input", form).each(function () {
            $this = $(this);
            var type = this.type;
            var tag = this.tagName.toLowerCase();
            switch (type) {
                case "checkbox":
                    $this.prop("checked", false);
                    break;
                case "radio":
                    $this.prop("checked", false);
                    break;
                default:
                    $this.val("");
                    break;
            }
            switch (tag) {
                case "textarea":
                    this.value = "";
                    break;
                case "select":
                    this.selectedIndex = 1;
                    break;
                default:
                    // nada que hacer
                    break;
            }
        });
    }
    $_success = function ($this) {
        var $target = (typeof ($this.data("modal-open")) != 'undefined') ? $($this.data("modal-open")) : false;
        if ($target != false) {
            $target.modal("show");
        }
        var $target = (typeof ($this.data("modal-close")) != 'undefined') ? $($this.data("modal-close")) : false;
        if ($target != false) {
            $target.modal("hide");
        }
        var $target = (typeof ($this.data("serialize")) != 'undefined') ? $($this.data("serialize")) : false;
        if ($target != false && typeof ($target[0]) != 'undefined') {
            $_reset($this.data("serialize"));
            $target[0].reset();
        }
        var $target = (typeof ($this.data("reset")) != 'undefined') ? $($this.data("reset")) : false;
        if ($target != false && typeof ($target[0]) != 'undefined') {
            $_reset($this.data("reset"));
            $target[0].reset();
        }
    }

    $(document).on('click', '.AjaxAction', function (e) {
        e.preventDefault();
        var $this = $(this);
        var $id_form = $this.data("serialize");
        var $form = $($id_form);

        if ($form.length > 0 && $id_form != undefined && $form[0].checkValidity() === false) {
            $form[0].classList.add('was-validated');
            e.preventDefault()
            e.stopPropagation()
        } else {
            $tmpl_id = $this.data("tmpl-id");
            $tmpl_location = $this.data("tmpl-location");
            $fn_success = $this.data("fn-success");
            $confirm = $this.data("confirm");
            $confirm_title = ($this.data("confirm-title") != undefined) ? $this.data("confirm-title") : "";
            $confirm_type = ($this.data("confirm-type") != undefined) ? $this.data("confirm-type") : "info";

            if ($confirm != undefined) {
                Swal.fire({
                    title: $confirm_title,
                    text: $confirm,
                    icon: $confirm_type,
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#dd3333',
                    confirmButtonText: 'Si'
                }).then((result) => {
                    if (result.value) {
                        $this.ajaxAction({
                            "headers": {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            "success": function (data) {
                                if (data.success) {
                                    $_success($this);
                                    if ($fn_success != undefined && typeof (window[$fn_success]) == 'function') {
                                        window[$fn_success](data);
                                    }
                                }
                            }
                        });
                    }
                });
            } else {
                $this.ajaxAction({
                    "headers": {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    "success": function (data) {
                        if (data.success) {
                            $_success($this);
                            if ($fn_success != undefined && typeof (window[$fn_success]) == 'function') {
                                window[$fn_success](data);
                            }
                        }
                    }
                });
            }
        }
    });

    // FUNCTION BARRIDO
    $(document).on('click', '.btn-remove-item-barrido', function (e) {
        $(this).parent().parent().remove();
        var $list = $("tbody#list_barrido>tr[data-doc]");
        if ($list.length == 0) {
            $(".btn-start-barrido").fadeOut(50);
        }
    });
    $(document).on('click', '.btn-remove-barrido', function (e) {
        $("#list_barrido>tr").remove();

        $(".btn-start-barrido").fadeOut(50);

    });

    $(document).on('click', '#add_num_doc', function (e) {
        var _list = $("#list_num_doc").val();
        var num_doc = _list.split(",");
        $.each(num_doc, function (index, value) {
            $tr = $('#B' + $.trim(value));
            if (!$tr.length && ($.trim(value)).length == 8) {
                var _tr = '<tr id="B' + $.trim(value) + '" data-doc="' + $.trim(value) + '">' +
                    '<td></td>' +
                    '<td colspan="3" class="text-center">DNI: ' + value + '</td>' +
                    '<td colspan="2" class="message"></td>' +
                    '<td>' +
                    '<button class="btn btn-xs btn-danger btn-remove-item-barrido">' +
                    '<i class="fa fa-fw fa-trash"></i>' +
                    '</button>' +
                    '</td>' +
                    '</tr>';
                $("#list_barrido").prepend(_tr);
            }
        });
        var $list = $("tbody#list_barrido>tr[data-doc]");
        if ($list.length) {
            $(".btn-start-barrido").fadeIn(250);
        }
        $("#list_num_doc").val("");
    });

    $(document).on('click', '.btn-start-barrido', async function (e) {
        $this = $(this);
        var $list = $("tbody#list_barrido>tr[data-doc]");
        $fn_success = $this.data("fn-success");

        var opts = {
            data: {
                FormID: "serialize", // ID Formulario
                url: "url", // url
                extra: "json", // Informa extra ( JSON )
                method: "method", // metodo de envio
            },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            beforeSend: function () { }, // function
            before: function () { }, // function
            complete: function () { }, // function
            success: function () { }, // function
            after_success: function () { }, // function
            error: function () { }, // function
            type: "POST", // string
            cache: false, // bool
            contentType: false, //"application/x-www-form-urlencoded",
            processData: false, // bool
            async: true, // bool
            dataType: "json" // string
        };

        var $this = $(this);
        var _serialize = $this.data(opts.data.FormID); // ID de Form a enviar
        var _destine = $this.data(opts.data.url); // URL destino (use:data-url o href)
        var _extra = $this.data(opts.data.extra); // Datos extra en json
        var _contentType = opts.contentType;
        var _formData = new FormData();

        if (typeof ($this.data(opts.data.method)) != 'undefined') {
            _type = $this.data(opts.data.method);
            //if (_type == 'PUT' || _type == 'DELETE' || _type == 'PATCH' || _type == 'HEAD') //...
            _formData.append('_method', _type);
        }

        if (typeof (_serialize) != 'undefined') {
            if (typeof ($(_serialize)) != 'undefined') {
                _formData = $(_serialize).serializefiles();
                //_contentType = 'multipart/form-data';
            }
        } else if ($this.attr("type") == "submit" && typeof ($this.parents('form')) != 'undefined') {
            _formData = $this.parents('form').serializefiles();
        }

        if (typeof (_extra) != 'undefined') {
            $.each(_extra, function (i, val) {
                _formData.append(i, val);
            });
        }

        if (typeof (_destine) == 'undefined') {
            if (typeof ($this.attr("href")) != 'undefined') {
                _destine = $this.attr("href");
            } else if (typeof ($this.parents('form').attr('action')) != 'undefined') {
                _destine = $this.parents('form').attr('action');
            } else {
                console.log("Undefined URL");
                return false;
            }
        }

        if (!$list.length) {
            Swal.fire({
                title: 'NO CONTENT!!!',
                icon: 'error',
                text: 'Añada elementos para buscar',
                timer: 5000,
            });
        } else {
            $this.hide();

            $total = $list.length;
            $cont = 0;
            $barra = $("#barrido-progress>.progress-bar");
            $porciento = 0;
            $barra.text($porciento + "%");
            $barra.attr("style", "width:" + $porciento + "%");

            var chain = $.when();
            await $.each($list, async function (index, tr) {
                chain = chain.then(function () {
                    var _num_doc = $(tr).data("doc");
                    _formData.set("num_doc", _num_doc);
                    console.log(_num_doc);
                    return $.ajax({
                        url: _destine,
                        data: _formData,
                        type: opts.type,
                        cache: opts.cache,
                        contentType: _contentType,
                        processData: opts.processData,
                        async: opts.async,
                        dataType: opts.dataType,
                        headers: opts.headers,
                        beforeSend: function () {
                            opts.beforeSend(_formData);
                        },
                        complete: function (x, s) {
                            opts.complete();
                        },
                        error: function () {
                            opts.error();
                            Swal.fire({
                                icon: 'error',
                                title: 'ERROR!!!',
                                text: 'Parece que el servidor no responde!',
                            });
                        },
                        success: function (respuesta) {
                            $cont += 1;
                            $porciento = Math.round($cont * (100 / $total));
                            $barra.text($porciento + "%");
                            $barra.attr("style", "width:" + $porciento + "%");

                            opts.success(respuesta);
                            if (typeof (respuesta['update']) != 'undefined') {
                                for (var i = 0; i < respuesta['update'].length; i++) {
                                    if (respuesta['update'][i]['action'] == "prepend") {
                                        $("#" + respuesta['update'][i]['id']).prepend(respuesta['update'][i]['value']);
                                    } else if (respuesta['update'][i]['action'] == "append") {
                                        $("#" + respuesta['update'][i]['id']).append(respuesta['update'][i]['value']);
                                    } else if (respuesta['update'][i]['action'] == "replaceWith") {
                                        $("#" + respuesta['update'][i]['id']).replaceWith(respuesta['update'][i]['value']);
                                    } else if (respuesta['update'][i]['action'] == "html") {
                                        $("#" + respuesta['update'][i]['id']).html("" + respuesta['update'][i]['value']);
                                    } else if (respuesta['update'][i]['action'] == "text") {
                                        $("#" + respuesta['update'][i]['id']).text("" + respuesta['update'][i]['value']);
                                    } else if (respuesta['update'][i]['action'] == "val") {
                                        $("#" + respuesta['update'][i]['id']).val("" + respuesta['update'][i]['value']);
                                    } else if (respuesta['update'][i]['action'] == "hide") {
                                        $("#" + respuesta['update'][i]['id']).hide();
                                    } else if (respuesta['update'][i]['action'] == "show") {
                                        $("#" + respuesta['update'][i]['id']).show();
                                    } else if (respuesta['update'][i]['action'] == "remove") {
                                        $("#" + respuesta['update'][i]['id']).remove();
                                    } else if (respuesta['update'][i]['action'] == "reset") {
                                        $("#" + respuesta['update'][i]['id'])[0].reset();
                                    } else if (respuesta['update'][i]['action'] == "addClass") {
                                        $("#" + respuesta['update'][i]['id']).addClass(respuesta['update'][i]['value']);
                                    } else if (respuesta['update'][i]['action'] == "removeClass") {
                                        $("#" + respuesta['update'][i]['id']).removeClass(respuesta['update'][i]['value']);
                                    } else if (respuesta['update'][i]['action'] == "toggleClass") {
                                        $("#" + respuesta['update'][i]['id']).toggleClass(respuesta['update'][i]['value']);
                                    } else if (respuesta['update'][i]['action'] == "prop") {
                                        $("#" + respuesta['update'][i]['id']).prop(respuesta['update'][i]['name'], respuesta['update'][i]['value']);
                                    } else if (respuesta['update'][i]['action'] == "attr") {
                                        $("#" + respuesta['update'][i]['id']).attr(respuesta['update'][i]['name'], respuesta['update'][i]['value']);
                                    } else if (respuesta['update'][i]['action'] == "modal") {
                                        $("#" + respuesta['update'][i]['id']).modal("" + respuesta['update'][i]['value'] + "");
                                    } else if (respuesta['update'][i]['action'] == "notification") {
                                        if (typeof (respuesta['update'][i]['message']) != 'undefined') {
                                            Swal.fire({
                                                title: respuesta['update'][i]['message']['title'],
                                                icon: respuesta['update'][i]['message']['type'],
                                                text: respuesta['update'][i]['message']['message'],
                                                timer: 2500,
                                            });
                                        }
                                    }
                                }
                            }
                            if (respuesta['success'] != false) {
                                if (typeof (respuesta['message']) != 'undefined') {
                                    Swal.fire({
                                        title: 'EXITO!!!',
                                        icon: 'success',
                                        text: respuesta['message'],
                                        timer: 5000,
                                    });
                                }
                            } else {
                                if (typeof (respuesta['message']) != 'undefined') {
                                    $(tr).addClass("table-danger");
                                    $(tr).children('.message').html('<span class="text-danger">' + respuesta['message'] + '</span>');
                                }
                            }
                            opts.after_success(respuesta);
                        }
                    });
                });
            });
        }
    });
});
