            jQuery.noConflict();
            jQuery(document).ready(function () {

                jQuery(document).ajaxError(function(e, xhr, settings, exception) {
                    jQuery.unblockUI;
                    if (xhr.status == 401){
                        alert('Su usuario no tiene permisos para acceder a esta p�gina');
                        if (!jQuery('#authMessageJs')){
//                            var authMessage = '<div id="authMessageJs" class="message">Usted no tiene permisos para realizar esta operaci�n</div>';
//                            jQuery('#main-content').prepend(authMessage);
                        }
                    }

                });

                jQuery('#boxTickets').click(function () {
                    if (apretado == false) {
                        jQuery('#pendientes').ajaxSubmit(options);
                        apretado = true;
                    }

                    return false;
                });

                jQuery("ul.menu_body li:even").addClass("alt");
                jQuery('#boxInstituciones .menu_body').show();


                   // jQuery('.menu_body').show();

                    jQuery('.menu_head, .menu_head_open').click(function () {
                        if(jQuery(this).hasClass('menu_head')){
                            jQuery(this).removeClass('menu_head').addClass('menu_head_open');

                            // guarda en cookie para recordar
                            Set_Cookie( 'opened_tag', this.id, '', '/', '', '' );
                        }else if(jQuery(this).hasClass('menu_head_open')){
                            jQuery(this).removeClass('menu_head_open').addClass('menu_head');

                            // si existe en cookie borra
                            if ( Get_Cookie( 'opened_tag' ) == this.id ) {
                                Delete_Cookie('opened_tag', '/', '');
                            }
                        }
                        jQuery('#' + this.id + ' ul.menu_body').slideToggle('medium');
                    });

                    /*jQuery('.slide-out-div').tabSlideOut({
                            tabHandle: '.handle',                     //class of the element that will become your tab
                            pathToTabImage: '<?=$html->url("/img/contact_tab.gif")?>', //path to the image for the tab //Optionally can be set using css
                            imageHeight: '122px',                     //height of tab image           //Optionally can be set using css
                            imageWidth: '40px',                       //width of tab image            //Optionally can be set using css
                            tabLocation: 'left',                      //side of screen where tab lives, top, right, bottom, or left
                            speed: 300,                               //speed of animation
                            action: 'click',                          //options: 'click' or 'hover', action to trigger animation
                            topPos: '200px',                          //position from the top/ use if tabLocation is left or right
                            leftPos: '20px',                          //position from left/ use if tabLocation is bottom or top
                            fixedPosition: false                      //options: true makes it stick(fixed position) on scroll
                    });*/
                });


                function openMenues() {
                    var arrayOfDivs = document.getElementsByTagName('div');
                    var howMany = arrayOfDivs.length;

                    for (var i=0; i < howMany; i++) {
                        var thisDiv = arrayOfDivs[i];
                        var styleClassName = thisDiv.className.value;

                        if (Get_Cookie( 'opened_tag' ) != null && Get_Cookie( 'opened_tag' ).toString() == thisDiv.id) {
                            //document.getElementById(thisDiv.id).className.value = 'menu_head_open';
                            jQuery('#' + thisDiv.id + ' h1').removeClass('menu_head').addClass('menu_head_open');
                            jQuery('#' + thisDiv.id + ' ul.menu_body').slideToggle('medium');
                        }
                    }
                }

                function borrarCookies() {
                    // si existe en cookie borra
                    if ( Get_Cookie( 'opened_tag' )) {
                        Delete_Cookie('opened_tag', '/', '');
                    }
                }


                function Set_Cookie( name, value, expires, path, domain, secure )
                {
                    // set time, it's in milliseconds
                    var today = new Date();
                    today.setTime( today.getTime() );

                    /*
            if the expires variable is set, make the correct
            expires time, the current script below will set
            it for x number of days, to make it for hours,
            delete * 24, for minutes, delete * 60 * 24
                     */
                    if ( expires )
                    {
                        expires = expires * 1000 * 60 * 60 * 24;
                    }
                    var expires_date = new Date( today.getTime() + (expires) );

                    document.cookie = name + "=" +escape( value ) +
                        ( ( expires ) ? ";expires=" + expires_date.toGMTString() : "" ) +
                        ( ( path ) ? ";path=" + path : "" ) +
                        ( ( domain ) ? ";domain=" + domain : "" ) +
                        ( ( secure ) ? ";secure" : "" );
                }

                function Get_Cookie( name ) {

                    var start = document.cookie.indexOf( name + "=" );
                    var len = start + name.length + 1;
                    if ( ( !start ) &&
                        ( name != document.cookie.substring( 0, name.length ) ) )
                    {
                        return null;
                    }
                    if ( start == -1 ) return null;
                    var end = document.cookie.indexOf( ";", len );
                    if ( end == -1 ) end = document.cookie.length;
                    return unescape( document.cookie.substring( len, end ) );
                }

                // this deletes the cookie when called
                function Delete_Cookie( name, path, domain ) {
                    if ( Get_Cookie( name ) ) document.cookie = name + "=" +
                        ( ( path ) ? ";path=" + path : "") +
                        ( ( domain ) ? ";domain=" + domain : "" ) +
                        ";expires=Thu, 01-Jan-1970 00:00:01 GMT";
                }
