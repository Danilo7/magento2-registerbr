/**
 * Created by PhpStorm.
 * @author Danilo Cavalcanti de Moura
 * Email: danilo-cm@hotmail.com
 */

define(['jquery','inputMask'],function($){
    return function(){
        jQuery('#type_person').change(function () {
            jQuery('#taxvat').val('');
            var value = jQuery('#type_person option:selected').val();

            if (value === '1') {
                jQuery('#taxvat').mask('999.999.999-99');
            }

            if (value === '0') {
                jQuery('#taxvat').mask('99.999.999/9999-99');
            }
        });

        if (jQuery('#type_person_hidden').length) {
            if (jQuery('#type_person_hidden').val() === '1') {
                jQuery('#taxvat').mask('999.999.999-99');
            } else {
                jQuery('#taxvat').mask('99.999.999/9999-99');
            }
        }
    }
});