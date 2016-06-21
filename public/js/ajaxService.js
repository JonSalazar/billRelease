

var sendByAjax = function (_url, _data, _callback) {
	$.ajax({
		url:   _url,
		type:  'get',
		data:  _data,
		success:  function (data) {
			_callback(data);
		}
	});
}
	