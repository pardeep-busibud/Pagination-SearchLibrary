
        function make_table_pagination(ajax_url,ajax_data,table_div_id,data_per_page,input_value,search_enable_or_desiable,type,reload) 
        {
            
            var buffer_size= buffer_size || 40;
            var current_page= current_page || 1;
            var data_per_page= data_per_page || 10;
            var type= type || 'data';
            var ajax_url= ajax_url || "";
            var table_no= table_no || 2;
            var pagination_on_click='';
            
            var table_div_id=table_div_id || '.body';
            var input_value=input_value || '';
            var reload=reload || '';
            var search_enable_or_desiable=search_enable_or_desiable || false;
            var date_filter_enable_desable=date_filter_enable_desable || false;


            var manage_buffer={
                total_data:{},
                max_page1:0,
                ajax_timeout:'',
                total_length:0,
                data_not_fount:'',
                date_not_found:'',
                search_div_counter:0,
                table_heading_names: new Array(),
                table_coulmn_names:new Array(),
                buffer_size_from_to:new Array(),

        construct:function(fun)
        {
            this.html_fun=fun;
            
        },
        manage_buffer_findPage:function(page)
        {   
           
            var range_from=current_page;
            var range_to=current_page+4;
            var flag=1;
            for (var i = 0; i < 4; i++) 
            {   //debugger;
                if(page-flag>0)
                {
                    range_from=current_page-flag;
                }
                flag++;
            }
            var buffer_range=new Array();
            buffer_range[0]=range_from;
            buffer_range[1]=range_to;
            return buffer_range;
        },
        manage_buffer_WhetherBufferExists:function(buffer_range)
        {
            var page_not_present= new Array();
            var flag1=0;
            for (var i = buffer_range[0]; i <= buffer_range[1]; i++) 
            {
                if(this.total_data[i]==undefined)
                {
                    page_not_present[flag1]=i;
                    flag1++;
                    if(i==current_page)
                    {

                        $("#loading").show();
                        
                    }

                }   

            }
            return page_not_present;  
        },
        manage_buffer_GetPageRange:function(page_not_present)
        {
            var from=page_not_present[0];
            var to=page_not_present[0];
            if(page_not_present.length>1)
            {
                var from_next=page_not_present[1];   
            }
            //var buffer_size_from_to=new Array();
            var flag=0;
            this.buffer_size_from_to[flag]=""+from+""+","+""+to+"";
            for (var i = 1; i <page_not_present.length; i++) 
            {   //debugger;

                if((to+1)==page_not_present[i])
                {   
                    to=page_not_present[i];
                    from_next=page_not_present[i+1];
                    this.buffer_size_from_to[flag]=""+from+""+","+""+to+"";
                }
                else
                {   
                    flag++;
                    to=from_next;
                    from=from_next;
                    this.buffer_size_from_to[flag]=""+from+""+","+""+to+"";
                    to=page_not_present[i];
                    from_next=page_not_present[i+1];
                }
                
            }
            if(this.buffer_size_from_to[0]!='undefined,undefined')
            {    
                return this.buffer_size_from_to;
                //manage_buffer_SendAjax(buffer_size_from_to,type);
            }
            else
            {
                this.buffer_size_from_to='undefined';
                return this.buffer_size_from_to;
            }
        },
        manage_buffer_SendAjax:function(ajax_data)
        {
            // debugger;

            $.ajax({ 
                        type:"POST",
                        async: "false",
                        url:ajax_url,
                        data:ajax_data,
                        dataType: 'json',
                        beforeSend()
                        {
                           //$("#loading").show(); 
                        },
                        success(data)
                        {    
                            // debugger;
                           manage_buffer.manage_buffer_AddData(data);
                           $("#loading").hide();

                        },
                        error: function() 
                        {
                            alert('Error occured!');
                        }
                    }); 
        },
        manage_buffer_AddData:function(response)
        {   //debugger
            //console.log(this.total_data);
            this.data_not_fount='';
            this.date_not_found='';
            this.table_heading_names=response['table_heading_name'];
            this.table_coulmn_names=response['table_column_name'];
            // $('#DataNotFound').hide();
            // $('#DateNotFound').hide();
            if(!jQuery.isEmptyObject(response['total_data']))
            {
                //console.log('notempty');
                if(response=='Invalid Date or month')
                {   
                    //console.log(response);
                    // $("#DateNotFound").show();
                    this.date_not_found='date not found';
                    this.max_page1=1;
                }
                else
                {
                  if(current_page==1)
                    {
                        this.total_length=response['total_length'];

                    }
                    var new_total_length=response['total_length'];; 
        
                    if(this.total_length!=new_total_length)
                    {
                        this.total_data={};
                        this.total_length=new_total_length;
                    }
                    for (var key in response['total_data']) 
                    {
                        //console.log(key);
                        this.total_data[key] =response['total_data'][key];
                        this.max_page1=response['max_page'];
                        // 
                    }   
                }
                
            }
            else
            {    
                // console.log('hello1');
                // console.log(jQuery.isEmptyObject(total_data));
                $("#tbodyid_data_upcoming tbody").empty();
                if(type=='search' && current_page==1 && jQuery.isEmptyObject(this.total_data))
                {   
                    //console.log('hello');
                    // $("#DataNotFound").show();
                    this.data_not_fount='data not found';
                    
                    this.max_page1=1;
                }
            }
            console.log(type);
            manage_buffer.html_fun(this.max_page1);
           
        }
        };
        var manage_html={
        make_new_pagination:function(max_page)
        {   
            //debugger;
            var max_page=max_page;
            var pagi_id=manage_html.make_new_table(current_page);
            $("#"+pagi_id).pagination(
            {      

                pages:max_page,
                cssStyle: 'light-theme',
                currentPage: current_page,
                onPageClick: function (page, event) 
                {
                //debugger;
                    
                    current_page=page;
                    //ajax_data;
                    //console.log(manage_buffer.current_page);
                    manage_buffer.construct(manage_html.make_new_pagination);
                    var buffer_range=manage_buffer.manage_buffer_findPage(current_page);
                    //console.log(buffer_range);
                    var page_not_present=manage_buffer.manage_buffer_WhetherBufferExists(buffer_range)
                    var get_page_range=manage_buffer.manage_buffer_GetPageRange(page_not_present);
                    
                    ajax_data['buffer_data']=JSON.stringify(get_page_range);
                    console.log(get_page_range);
                    if(get_page_range!='undefined')
                    {
                        manage_buffer.manage_buffer_SendAjax(ajax_data);
                    }
                    pagination_on_click='pagi';
                    //make_table_pagination(ajax_url,ajax_data);
                    manage_html.make_new_table(current_page);    
                }
            });
            
        },
        make_new_table:function(current_page_new)
        {    
            //debugger;
            console.log(type);
            var tbody_ids=new Array('myTable','myTable1','myTable2','myTable3','myTable4','myTable5');
            //console.log(tbody_ids);
            var current_page_data=new Array();
            var current_page_data=manage_buffer.total_data[current_page_new];
            //console.log(current_page_data)
            var tbody_id=$('tbody');
            var tb_id_name='';
            var pagination_id_name='';
            var id_tbody = [];
            for(var i=0;i<tbody_id.length;i++)
            {
                id_tbody.push(tbody_id[i].id);
            }
        
            console.log(id_tbody); 
            if(id_tbody.length==0)
            {
                tb_id_name='myTable';
                pagination_id_name='pagination_'+tb_id_name;
                //console.log(pagination_id_name);
            }
            if(type=='search' ||pagination_on_click=='pagi' || reload=='reload')
            {
                var search_id=$(table_div_id).find('table tbody').attr('id');
                tb_id_name=search_id
                pagination_id_name='pagination_'+tb_id_name; 
                //console.log(table_div_id);
                //var a=$(table_div_id).find('table').length;
                
            }
            else
            {
                
               if(type!='search' ||pagination_on_click!='pagi' ||reload=='reload') 
               {


                $.each(tbody_ids ,function (index, value_arr)
                {   //console.log(index+1);
                    var flag=0;
                    $.each(id_tbody ,function (index, value_got)
                    {
                        // console.log(value_got);
                        // console.log(value_arr);
                        if(value_arr==value_got)
                        {
                            // console.log(value_got);
                            // console.log(value_arr);
                           flag=1;
                           //return false;
                        }
                        
                    });
                    //console.log(flag);
                    if(flag==0)
                    {
                        tb_id_name=value_arr;
                        pagination_id_name='pagination_'+tb_id_name;
                        return false;
                    }
                });
                }
            }
            //console.log(tb_id_name);
            tth='';
            $.each(manage_buffer.table_heading_names, function(index, value)
            {
                tth+='<th>'+value+'</th>';
            });
            if(manage_buffer.search_div_counter==0)
            {
                var table='<div class="panel-body" ><div class="row search_div" id="search_div"><div class="col-md-6"><div id="date_filter"><button id="today" class="btn btn-primary date_btn" value="today">Today</button> <button id="last_week" class="btn btn-primary date_btn" value="last_week">Last Week</button> <button id="last_month" class="btn btn-primary date_btn" value="last_month">Last Month</button></div></div><div class="col-md-6"><div class="form-group" id="search_id"><input type="input" class="form-control input-lg" id="txt-search" selectd_div='+table_div_id+' placeholder="Filter results"></div></div></div><div style="overflow-x:auto;"><table class="table table-bordered table-custom" id = "tbodyid_data_upcoming"><thead><tr>'+tth+'</tr></thead><tbody id='+tb_id_name+'></tbody></table></div><div id="data_not_found"></div><div class="pagination_page" style="margin-bottom: 50px"><ul id='+pagination_id_name+' class="pagination-lg pull-right"></ul></div></div>';
            }
            //$('#search_div').remove();
            //$(".panel-body").remove();
            $("#"+tb_id_name+" tr").remove();
            $("#data_not").remove();
            //console.log(manage_buffer.table_div);
            // var table='<div class="panel-body"><div class="row search_div" id="search_div"><div class="col-md-6"></div><div class="col-md-6"><div class="form-group"><input type="input" class="form-control input-lg" id="txt-search" placeholder="Filter results"></div></div></div><div style="overflow-x:auto;"><table class="table table-bordered table-custom" id = "tbodyid_data_upcoming"><thead><tr>'+tth+'</tr></thead><tbody id="myTable"></tbody></table></div><div id="data_not_found"></div><div class="pagination_page" style="margin-bottom: 50px"><ul id="pagination-demo" class="pagination-lg pull-right"></ul></div></div>';
            if(type!='search' && reload!='reload')
            {
                $(table_div_id).append(table);
            }
            
            var append_data='';
            var tr_id=0;
            $.each(current_page_data ,function (index, value)
            {   
                var ttd='';
                var value_of_id='';
                $.each(manage_buffer.table_coulmn_names, function(index,valueOfColumn)
                {                       
                    

                    if(valueOfColumn=='id')
                    {
                        value_of_id=value[valueOfColumn];
                    }
                    else
                    {
                        ttd+='<td>'+value[valueOfColumn]+'</td>'; 
                    }
                    //ttd+='<td>'+value[valueOfColumn]+'</td>'; 

                    
                    // console.log(ttd);
                });
                
                append_data+='<tr value='+value_of_id+' id='+tr_id+'>'+ttd+'</tr>';
                tr_id++;
                  
            });
            if(search_enable_or_desiable)
            {
                // var table='<div ><div id="ser">'+search+'</div><div ><table class="table table-bordered table-hover" id="tbl"><thead><tr>'+tth+'</tr></thead><tbody>'+append_data+'</tbody></table></div><div id="data_not_found"></div></div></div></div>';
            }
            else
            {
                $(""+table_div_id+" #search_id").remove();
                //var table='<div class="panel-body"><table lass="table table-bordered table-custom" id="tbl"><thead><tr>'+tth+'</tr></thead><tbody>'+append_data+'</tbody></table></div><div id="data_not_found"></div></div>';
            }
            if(date_filter_enable_desable==false)
            {
                $(""+table_div_id+" #date_filter").remove();
            }
            //console.log(append_data);
            $('#'+tb_id_name).append(append_data);
            //var pagination='<div><ul id="pagination-demo" class="pagination-lg pull-right"></ul></div>';
            
            if(manage_buffer.data_not_fount)
            {
                 //$("#ser").remove();
                $(""+table_div_id+" #data_not_found").append('<div id="data_not" align="center"><h3>Data Not Found</h3> </div>');
            }
            if(manage_buffer.date_not_found)
            {
                $(""+table_div_id+" #data_not_found").append('<div align="center"><h3>Invalid Date or month</h3> </div>');
            }
            manage_buffer.search_div_counter=1;
            return pagination_id_name;
            //$(pagination_div_id).append(pagination);
        }};

            manage_buffer.construct(manage_html.make_new_pagination);
            var buffer_range=manage_buffer.manage_buffer_findPage(current_page);
            //console.log(buffer_range);
            var page_not_present=manage_buffer.manage_buffer_WhetherBufferExists(buffer_range,current_page)
            var get_page_range=manage_buffer.manage_buffer_GetPageRange(page_not_present);
            //console.log(get_page_range);
        //console.log(buffer_size_from_to);
            var ajax_data = ajax_data || {};
                ajax_data["request"]=type;
                ajax_data["buffer_data"]=JSON.stringify(get_page_range);
                ajax_data["data_per_page"]=data_per_page;
                ajax_data["input_value"]=input_value;
            
            //return ajax_data;
            if(get_page_range!='undefined')
            {
                
                manage_buffer.manage_buffer_SendAjax(ajax_data,ajax_url);
            } 
        }
