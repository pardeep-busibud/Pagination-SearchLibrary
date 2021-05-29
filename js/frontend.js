const manage_html = {
	make_html:function(){
		var ajax_url='/./Pagination-SearchLibrary/php/backend.php?XDEBUG_SESSION_START=sublime.xdebug';
		var ajax_data={};
		var table_div_id='#main_div';
		var input_value='';
		var data_per_page=10;
		var search_enable_or_desiable=true;
		var type='data';
		make_table_pagination(ajax_url,ajax_data,table_div_id,data_per_page,search_enable_or_desiable,input_value);
	}
}
let manage_html_obj = Object.create(manage_html);
manage_html_obj.make_html();