(function($){
	//カードが選ばれるまで、終了ボタンを非活性
	$('#toExecRandomTestControl').attr('disabled', true);

	var data = { type : "init"};
	$.ajax({
		url: "module/InputExecRandomTestControl.php",
		type: "POST",
		data: data,
		dataType: 'json'
	})
	.done(function( data ){
		if(data.status == 'fail'){
			location.href = '/testApp/error.php';
		}
		else{
			// 取得した質問内容を描画
			$('#add_point').empty();
			$('#add_point').append(data.prifix);
			$('#add_point').append(data.point);
		}
	});
	$("#toExecRandomTestControl").click(function(){
		var data = { type : "complete"};
		$.ajax({
			url: "module/InputExecRandomTestControl.php",
			type: "POST",
			data: data,
			dataType: 'json'
		})
		.done(function( data ){
			if(data.status == 'fail'){
				location.href = '/testApp/error.php';
			}
			else {
				location.href = '/testApp/mypage.php';
			}
		});
		return false;
	});
	$("#toBack").click(function(){
		location.href = "/testApp/inputExecGrowthTest.php";
		return false;
	});
	$.fn.rotate_box = function(){
		var	elm = $(this),
		elm_in = $('.inner', this),
		btn = $('.number, .back', elm),
		deg = 0,
		turn = false,
		turn_cls = 'reverse';

		var rotate_anm = function(){
			elm_in.css({
				'transform' : 'rotateY(' + deg * -2 + 'deg)'
			});
		};

		var rotate = function(){
			setTimeout(function(){
				rotate_anm();
				if( deg == 45 ){
					if( turn === false ){
						elm.addClass(turn_cls);
					}
					else {
						elm.removeClass(turn_cls);
					}
					deg = 315;
				}
				if( deg <= 45 ){
					deg += 3;
					rotate();
				}
				else if( deg < 360 && deg > 45 ) {
					deg += 3;
					rotate();
				}
				else {
					deg = 0;
					elm_in.attr('style', '');
					if( turn === false ){
						turn = true;
					}
					else {
						turn = false;
					}
				}
			}, 5);
		};

		btn.click(function(){
			// 1回以上めくれないように制御
			if(!turn){
				rotate();
				//カードが選ばれたら、終了ボタンを活性
				$('#toExecRandomTestControl').attr('disabled', false);
			}
		});
	};
})(jQuery);

$('.card').each(function(){
	$(this).rotate_box();
});