function blockUI(){
	$.blockUI({
		message: '処理中',
		css: {
			border: 'none',
			padding: '20px',
			backgroundColor: '#333',
			opacity: .5,
			color: '#fff'
		},
		overlayCSS: {
			backgroundColor: '#000',
			opacity: 0.6
		}
	});
}
function unBlockUI(){
	$.unblockUI();
}
