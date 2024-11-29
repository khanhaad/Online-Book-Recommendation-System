function highlightStar(obj, id) {
	removeHighlight(id);
	$('.demo-table #tutorial-' + id + ' li').each(function(index) {
		$(this).addClass('highlight');
		if (index == $('.demo-table #tutorial-' + id + ' li').index(obj)) {
			return false;
		}
	});
}

function removeHighlight(id) {
	$('.demo-table #tutorial-' + id + ' li').removeClass('selected');
	$('.demo-table #tutorial-' + id + ' li').removeClass('highlight');
}

function addRating(obj, id) {
	$(obj).parent().find("#loader-icon").css("display", "inline-block");
	$('.demo-table #tutorial-' + id + ' li').each(function(index) {
		$(this).addClass('selected');
		$('#tutorial-' + id + ' #rating').val((index + 1));
		if (index == $('.demo-table #tutorial-' + id + ' li').index(obj)) {
			return false;
		}
	});
	$.ajax({
		url: "add-rating-ajax.php",
		data: 'id=' + id + '&rating=' + $('#tutorial-' + id + ' #rating').val(),
		type: "POST",
		success: function() {
			$(obj).parent().find("#loader-icon").hide();
		}
	});
}

function resetRating(id) {
	if ($('#tutorial-' + id + ' #rating').val() != 0) {
		$('.demo-table #tutorial-' + id + ' li').each(function(index) {
			$(this).addClass('selected');
			if ((index + 1) == $('#tutorial-' + id + ' #rating').val()) {
				return false;
			}
		});
	}
}