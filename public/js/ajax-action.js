/**/
async function doAjax(ajaxurl, args) {
    let result;

    try {
        result = await $.ajax({
            url: ajaxurl,
            type: 'POST',
            data: args,
            "headers": {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        return result;
    } catch (error) {
        console.error(error);
    }
}

/* ++++++++++++++++++++++++++++++++++++++
+	Create 	: 	Josue Mazco Puma		+
+	e-mail 	: 	JossMP@gmail.com		+
+	twitter : 	@JossMP777				+
++++++++++++++++++++++++++++++++++++++ */
(function ($) {
    $.fn.serializefiles = function () {
        var obj = $(this);
        /* ADD FILE TO PARAM AJAX */
        var formData = new FormData();
        $.each($(obj).find("input[type='file']"), function (i, tag) {
            $.each($(tag)[0].files, function (i, file) {
                formData.append(tag.name, file);
            });
        });
        var params = $(obj).serializeArray();
        $.each(params, function (i, val) {
            formData.append(val.name, val.value);
        });
        return formData;
    };
})(jQuery);
//////////////////////////////////////////////////////////////
(function ($) {
    $.ajaxblock = function () {
        $("body").prepend("<div id='ajax-overlay'><div id='ajax-overlay-body' class='center'><i class='fa fa-spinner fa-pulse fa-3x fa-fw'></i><span class='sr-only'>Loading...</span></div></div>");
        $("#ajax-overlay").css({
            position: 'absolute',
            color: '#FFFFFF',
            top: '0',
            left: '0',
            width: '100%',
            height: '100%',
            position: 'fixed',
            background: 'rgba(39, 38, 46, 0.67)',
            'text-align': 'center',
            'z-index': '9999'
        });
        $("#ajax-overlay-body").css({
            position: 'absolute',
            top: '40%',
            left: '50%',
            width: '120px',
            height: '48px',
            'margin-top': '-12px',
            'margin-left': '-60px',
            //background: 'rgba(39, 38, 46, 0.1)',
            '-webkit-border-radius': '10px',
            '-moz-border-radius': '10px',
            'border-radius': '10px'
        });
        $("#ajax-overlay").fadeIn(50);
    };
    $.ajaxunblock = function () {
        $("#ajax-overlay").fadeOut(100, function () {
            $("#ajax-overlay").remove();
        });
    };
    $.fn.extend({
        ajaxAction: async function (options) {
            var defaults = {
                data: {
                    FormID: "serialize", // ID Formulario
                    url: "url", // url
                    extra: "json", // Informa extra ( JSON )
                    method: "method", // metodo de envio
                },
                headers: {},
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
            var opts = $.extend(defaults, options);

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
            var chain = $.when();
            chain = chain.then(function () {
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
                        $.ajaxblock();
                    },
                    complete: function (x, s) {
                        $.ajaxunblock();
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
                                } else if (respuesta['update'][i]['action'] == "tmpl") { // require mustache.js
                                    if (typeof (respuesta['update'][i]['tmpl']) != 'undefined') {
                                        var template = $("#" + respuesta['update'][i]['tmpl']["id"]).html();
                                        var render = Handlebars.compile(template);
                                        var rendered = render(respuesta['update'][i]['tmpl']["data"]);
                                        //console.log(rendered);
                                        //console.log($("#" + respuesta['update'][i]['id']).html());
                                        if (respuesta['update'][i]['tmpl']['action'] == "html") {
                                            $("#" + respuesta['update'][i]['id']).html(rendered);
                                        } else if (respuesta['update'][i]['tmpl']['action'] == "append") {
                                            $("#" + respuesta['update'][i]['id']).append(rendered);
                                        } else if (respuesta['update'][i]['tmpl']['action'] == "prepend") {
                                            $("#" + respuesta['update'][i]['id']).prepend(rendered);
                                        } else if (respuesta['update'][i]['tmpl']['action'] == "replaceWith") {
                                            $("#" + respuesta['update'][i]['id']).replaceWith(rendered);
                                        } else if (respuesta['update'][i]['tmpl']['action'] == "before") {
                                            $("#" + respuesta['update'][i]['id']).before(rendered);
                                        } else if (respuesta['update'][i]['tmpl']['action'] == "after") {
                                            $("#" + respuesta['update'][i]['id']).after(rendered);
                                        }
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
                                Swal.fire({
                                    title: 'ERROR!!!',
                                    icon: 'error',
                                    text: respuesta['message'],
                                    timer: 5000,
                                });
                            }
                        }
                        if (typeof (respuesta['redirection']) != 'undefined') {
                            top.location.href = respuesta['redirection'];
                        }
                        opts.after_success(respuesta);
                    }
                });
            });
        }
    });
})(jQuery);
