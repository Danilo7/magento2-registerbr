/**
 * Created by PhpStorm.
 * @author Danilo Cavalcanti de Moura
 * Email: danilo-cm@hotmail.com
 */
define(['jquery'],function($){
    return function(){
        jQuery(document).ready(function () {
            jQuery('#type_person').change(function(){
                var value = jQuery('#type_person option:selected').val();

                if (value === '') {
                    //Hide inputs person type
                    jQuery('.type_physical, .type_legal')
                        .addClass('no-display')
                        .removeClass('required')
                        .children('div')
                        .children('input')
                        .attr('data-validate','');
                }

                if (value === '0') {
                    //Hide inputs person Physical
                    jQuery('.type_physical')
                        .addClass('no-display')
                        .removeClass('required')
                        .children('div')
                        .children('div')
                        .children('input')
                        .attr('data-validate','');

                    //Show inputs Person Legal
                    jQuery('.type_legal')
                        .removeClass('no-display')
                        .addClass('required')
                        .children('div')
                        .children('input')
                        .attr('data-validate','{required:true}');
                }

                if (value === '1') {
                    //Hide inputs Person Legal
                    jQuery('.type_legal')
                        .addClass('no-display')
                        .removeClass('required')
                        .children('div')
                        .children('input')
                        .attr('data-validate','');

                    //Show inputs person Legal
                    jQuery('.type_physical')
                        .removeClass('no-display')
                        .addClass('required')
                        .children('div')
                        .children('div')
                        .children('input')
                        .attr('data-validate','{required:true}');
                }
            });
        });
    }
});