<?php

?>
<script type="text/javascript">
(function ($) {
	$(document).ready(function(){


		$.ajax({ url: "https://webshop.donemus.nl/action/front/ajax?nieuw=", data: { sorteerDatum: "true", sorteerOmgekeerd: "false", presentatie: 2, limiet: 10 }, dataType: "json",  method: "POST", success: function(data) {
		
		var html = "";
		if (data.werken) {
			for (var i = 0; i < data.werken.length; i++) {
				var o;
				o = data.werken[i];
				console.log(o);
				html += "<a href='" + o.link + "' target='_blank' class='text-item-link hover-underline-animation' data-aos='zoom-out'><div class='link-normal-text-color underline-links'>" + o.titel + "</div></a>";
			}
			
			html += "<div class='shop-items-divider border--medium-top'></div><a href='https://webshop.donemus.com/action/front/search?name=%22<?php echo $lastname . '%2C+' . str_replace(' ', '+', $firstname); ?>%22&order=name' target='_blank' class='all-works-link text-item-link hover-underline-animation' data-aos='zoom-out'><div class='link-normal-text-color underline-links'><b><?php the_title(); ?> - complete list of works</b></div></a>"
			
			$("#latest_additions").html(html);
		} else {
			// no works found
			$('#latest_additions_container').hide();
		}
		
	}});


	});
})(jQuery);
</script>