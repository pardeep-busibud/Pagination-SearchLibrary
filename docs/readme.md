# Applicant Stage Process

## Introduction
	This process helps a new applicant to create his profile with helplama.It contains various stages following which an applicant hiring process will be completed.

## Purpose
	On which stage an applicant should go based on process will be decided by this Applicant Stage Process.Earlier this work is done manually.

## Dependencies

	1. Project Name: Applicant Stage Tracking
	2. Project Documentation Link:https://docs.google.com/document/d/1_BGX_zpIjeSDhr-eG6DdWR2vmMdBiNi_M95JbNX-4a8/edit#

## Key Points

### Stages:-
	1. Profile creation 
	2. Email verification
	3. Form fill
	4. Form Submission
	5. Mock Chat
	6. Programming message
		
### Question Type :-
	1. Simple text
	2. Textarea
	3. Radio Button
	4. Checkbox
	5. File upload

# **FrontEnd**

* **Global variable**

    1. **all_lang_text->**It contains all messages with their key value..

        1. all_lang_text(object)-:

            1. profile_created: {text: "Congratulations!  Your profile is created successfully.A mail is sent to you for verification.Please verify your email"}

            2. email_verified: {text: "Your Email is verified.please click the button below to  next step."}

            3. mock_chat: {text: "Mock chat"}

            4. form_submitted: {text: "Your form is submitted successfully"}

            5. file_size_alt: {text: "The file size is large. Must be a maximum 8 MB"}

**1.$( document ).ready(function() :-**

	On page load we are sending an ajax to check whether a session is already set or a new session established.if it is an old session we send an ajax to retrieve data by passing **e_id** of a session to get its current stage.

**[request=session_req].**

	If there is a new session establish then ajax will show a fresh sign up page.**

	**OR**

	if there is an old session** **then we get e_id of that session to fetch data from the database.

**i. Parameters:-**		

	No parameter

**ii. Return values:-**

	1)	Ajax parameters:-

		{'request_data':'ajax_data','request':'*session_req*'}
	2)	File to which data is sent:-
		http://localhost/applicant_process/application_controler.
		php?XDEBUG_SESSION_START=sublime.xdebug';
	3)	Table Affected(database.table_name):-
		(i)	helplama_applicant_tracking.process_stage_tracking
		(ii)	helplama_applicant_tracking.applicant_stage_tracking
	4)	Data received:-
		Current stage of applicant
		 ex.{"stage_id":"3","stage_name":"form_fill"}

``On this ajax success we append the data in the mainframe. $('.mainFrame').append(data['html']);``

**2.	$(document).on('click','#signup',function():-**

	On this event we are getting all the details that is coming  from the input and call the Method to send ajax to add details in database by sending [request=signup_data].
	
**i. Parameters:-**

	No parameter
	
**ii. Return values:-**

	1)	Ajax data:-	

		{name,Email,Password,Age,Phone,Gender,State,Country}

	2)	Ajax parameters:-	

		{'request_data':'ajax_data','request':'signup_data'}

	3)	File to which data is sent:-

		http://localhost/applicant_process/application_controler.php?XDEBUG_SESSION_START=sublime.xdebug';

	4)	Table Affected(database.table_name):-

		(i)	login_tbl.helplama_experts
		(ii)	login_tbl.login_tbl
		(iii)	helplama_contact_freelancer
	5)	Data received:-

		{"stage_id":"2","stage_name":"profile_created"}
					Or
		{Email already exists!}stay on signup page

	On this ajax success we append the data in the mainframe.
	$('.mainFrame').append(data['html']);	


**3.	$(document).on('click','.next_btn',function():-**

	On this event we are sending a ajax request to move to the next stage using the e_id and process_id of the session by sending [request=next_stage].
	
**i. Parameters:-**

	No parameter
	
**ii. Return values:-**

	1)	Ajax parameters:-	
		{'request_data':'ajax_data','request':'next_stage'}
		
	2)	File to which data is sent:-
	
		http://localhost/applicant_process/application_controler.php;
		
	3)	Table Affected(database.table_name):-
		(i)  helplama_applicant_tracking.process_stage_tracking
		(ii) helplama_applicant_tracking.applicant_stage_tracking
	4)	Data received:-
		Next Stage 
	ex.{"stage_id":"4","stage_name":"mock_chat"}

	On this ajax success we append the data in the mainframe. $('.mainFrame').append(data['html']);	
	
**4.	$(document).on('click','#login_btn',function():-**

	On this event we are sending an ajax request for login by taking Email and Password from input by sending [request=login].

**i. Parameters:-	**	

	No parameter
	
**ii. Return values:-**

	1)	Ajax data:-	
	
		{Email,Password}
	2)	Ajax parameters:-	
	
		{'request_data':'ajax_data','request':'login'}
	3)	File to which data is sent:-
	
		http://localhost/applicant_process/application_controler.php;
	4)	Table Affected(database.table_name):-
	
		(i)helplama_applicant_tracking.process_stage_tracking
		(ii)login_tbl.helplama_experts
		(iii)helplama_applicant_tracking.applicant_stage_tracking
		(iv)login_tbl.login_tbl
		
	5)	Data received:-
	
			Current Stageex{"stage_id":"3","stage_name":"form_fill"}
				OR
			{Username Or Password seems to be wrong}

		On this ajax success we append the data in the mainframe. $('.mainFrame').append(data['html']);


**5.	$(document).on('click','#login_button_forgot_btn',function():-**

	In this click event it sends forgot email password to agents if they have forgot their email password if email format is correct it will send ajax otherwise it will show error.

**i. Parameters:-	**	

	{'request':'forgotPassword','email':email_val {email address},'reset_link_address':domain_name_host {reset link url password},'support_email_msg':support_email_msg {support email message},'acount_email_msg':acount_email_msg {account email message},'domain_name':domain_name {domain name of currect page}}
	
**ii. Return values:-**

	1)	Call another funtion to send ajax for forgetting password

			 getform_obj.send_ajax(ajax_url,ajax_data);

	2)   Ajax data:-	
	
		{'request':'forgotPassword','email':email_val {email address},'reset_link_address':domain_name_host {reset link url password},'support_email_msg':support_email_msg {support email message},'acount_email_msg':acount_email_msg {account email message}}

	3)	Ajax parameters:-	
	
		{'request':'forgotPassword','email':email_val {email address},'reset_link_address':domain_name_host {reset link url password},'support_email_msg':support_email_msg {support email message},'acount_email_msg':acount_email_msg {account email message}}
	4)	File to which data is sent:-
	
		http://localhost/applicant_process/application_controler.php;
	
		
	5)	Data received:-
	
			1. if email send succesful and email is correct then it will return
				return
					1. array('msg'=>'An email has been sent you to reset your password .', 'error'=>false,'reset_link'=>$pass_reset_link)

			2. If agents multiple email detected then 
				return 	
					1. array('msg'=>'Some Problem Occurred(Multiple emails Detected).', 'error'=>true);
			3. If email is wrong then
				return
					1. array('msg'=>'Email seems to be wrong.', 'error'=>true);



## Objects and its Function:-

**if(data['html']['type']=='form_details')**

	In this condition according to the stage_id we will get data[type] from backend.here if we get the data then we are using the below object and function to show it on Frontend by passing data coming from backend as parameter.. create_obj.add_response_data(data['html']);

**(i).create_obj(object):- **

	We use this object as a service and manage the function which is used to get and make the data for the form_details.
	
**a.   add_response_data(function):-**

	This function is used to call the ajax to get all  data for the form_details.

**i. Parameters:-**

	data['html']	    
	
**ii. Function :-**

	(i).append_que_ans():-
	(ii).append_div_rdo_chk(type,que_text,number,order,q_id):-
	(iii).	append_div_text(type,que_text,number,q_id)
	(iv).	append_attetched_file(que_text,number,q_id):-
**iii.  Table Affected:-**

	(i).	question_tbl
	(ii).	Answer_tbl
	
**iv.	Data received:-**

	Question and its answer’s Option. ex{"1":{"id":"1","q_no":"Question text"}}
	
	On this ajax success we append the data in the mainframe. $('.mainFrame').append(data['html']); 

**if(data['html']=='message_key')**

	In this condition according to the stage_id we will get a message key from backend.here if we get the data then we are using the below object and function to show it on Frontend by passing data coming from backend as parameter. create_obj.add_response_msg(data['html']);

**(i).  create_obj(object)****:-**

	We use this object as a service and manage the function which is used to get a message from the library with respect to the key coming from the backend.

**a.add_response_msg(function)****:****-**

	This function is used to call the ajax to get a message using its key.

**i. Parameters:-**		

	data['html']		       

**ii. Function :-**

	(i).get_message_value(data);

**iii.  Data received:-** 
	{message text} ex= your email is verified

	On this ajax success we append the data in the mainframe. $('.mainFrame').append(data['html']);

## Function

**(1).	append_que_ans():-**

	This function is used to append all the question answers in the html form.

**(1).    append_div_rdo_chk(type,que_text,number,order,q_id):-**

	This function is used to append radio and checkbox questions and iterate their answers to append.here we get the **radio button id** to call further events.

**(1).	append_div_text(type,que_text,number,q_id)**

	This function is used to append text and textarea questions and their answers  to append.here we get the **checkbox id** to call further events.

**(1).	append_attetched_file(que_text,number,q_id):-**

	This function is used to append the upload file div in the  mainframe.here we get the **file_id **to call further events.

**(1).	get_message_value(data):-**

	This function take data key coming from backend and return its text message  from predefined library using global variable all_lang_text 

**(1) send_ajax(ajax_url {where we want to send ajax},ajax_data {all parameter which we want to send in ajax},this_data {scope of clicked button})**
	
	This function invokes whenever these events occur '#signup' {whwnever agent fill form for sign up}, '.next_btn' {On every next stage}, '#login_btn' {on login into his profile}. 
	

	**i. Parameters:-**		

		ajax_url {where we want to send ajax},ajax_data {all parameter which we want to send in ajax},this_data {scope of clicked button}

	**ii. return values:-**

	1. **Ajax**

		1)	Ajax parameters:-

			{'request_data':'ajax_data' {All parameters use into this variable}}

		2)File to which data is sent:-

			**ajax_url** {this depend upon which event called this function}

		3)	Data received:-**

			1. data {it gets different type of values and this all value is handling another function called this_data_obj.common_call_ajax_success(data)}

		4) Calling another function

			this_data_obj.common_call_ajax_success(data);

**(1) common_call_ajax_success(data {this parameters is sent from ajax success function})**
	
	This function invokes whenever ajax success of send_ajax function this function helps to handle success function reponse that what we need to do with that ajax success function responses.In this functions we have made multiple conditions to handle ajax reponse return which we are going to use in UI of our project. this function called from 2 or 3 ajax success function.
	

	i. Parameters:-	

		data {this parameters is sent from ajax success function}

	**ii. return values:-**

		1. Used multiple condition to handle multiple responses type which is used to change in UI
			1.data['html']['type']=='form_details'
				1. this response type make form in UI which is used to take take of agents they fill this form and we store data whatever they filled.

				2. this condition also call another function called

					create_obj.add_response_data(data['html']); {this function also call anothes function to make form in UI}
			2.data['html']['type']=='programming_msg'
				1.this conditon is used to show message which we have set it up in every process 
			3.If data['html']['type'] is not defined then it goes to else conditions of this conditions algorith there are also many conditons which we are using
				1.data['html'] =='email_verified'
					this conditon defines that agents email is verified in backend database now agent can go further stages to complete process
				2.data['html'] =='Profile_access'
					If this conditon comes then we just open modal to login but now not decided what needs to be done in this 
				3.data['html'] =='application_completed'
					In this stage also we show message and login button into profile
				4.data['html'] == 'Mock_chat'
					1. In this stage we append datetimepciker into UI with availables days and calling another functions

					2. This condition also call another function which is used to call ajax to get all active dates with available time data from backend
						1. manage_mock_chat_time.get_agent_date();



		

**Event**

**1 $(document).on('click','.radio_chk',function():-**

	On this event we send an ajax  request to call a function to save answers of radio_type or checkbox_type questions filled by the applicant while filling the form test or mock test.**[request=**insert_ans**].**

**i. Parameters:-**		

	e_id, q_id, ans, que_type

**ii. return values:-**

	1. **Ajax**

		1)	Ajax parameters:-

			{'request_data':'ajax_data','request':**'*insert_ans*'**}*

		2)File to which data is sent:-

			[http://localhost/applicant_process/fill_form_bknd.php](http://localhost/applicant_process/fill_form_bknd.php?XDEBUG_)

		3)	Data received:-**

				{saved} OR {saving....}

**2. $(document).on('keyup','.text_input,function():-**

	On this event we send an ajax  request to call a function to save answers of a text or textarea questions filled by the applicant while filling the form test or mock chat.**[request=**insert_ans**].**

**i. Parameters:-**		

	e_id, q_id, ans, que_type

**ii. return values:-**

2. **Ajax**

	**	1)	Ajax parameters:-	**

		*{'request_data':'ajax_data','request':**'*insert_ans*'**}*

	**2)***	***File to which data is sent:-**

		[http://localhost/applicant_process/fill_form_bknd.php](http://localhost/applicant_process/fill_form_bknd.php?XDEBUG_)

	**3)	Data received:-**

			{saved} OR {saving...}

 **3. $(document).on('click','#file_id,function():-**

	On this event we check the file max size. If the file size is greater than the condition’s max size then a message from the library will show using the global variable all_lang_text. **OR** If the file size is less than the max size decided by the condition then it will call an ata.

**i. Parameters:-**		

	No parameter

**ii. return values:-**

	3. **Ajax**

		1)	Ajax parameters:-

			{'request_data':'file_data'’}*

		2)File to which data is sent:-

			[http://localhost/applicant_process/fill_form_bknd.php?XDEBUG_](http://localhost/applicant_process/fill_form_bknd.php?XDEBUG_SESSION_START=sublime.xdebug';


		3)	Table Affected(database.table_name):-

			(i)	helplama_applicant_tracking.process_stage_tracking
			(ii)    helplama_applicant_tracking.applicant_stage_tracking

		4)	Data received:-

			{saved} OR {error: file size is greater than the max size}


## Database Structure

**a.	login_tbl:-**


![](images/image1.png)

**b.	Helplama_experts:-**

![](images/image2.png)

**c. applicant_stage_tracking:-**
![](images/image3.png)

**d. answer_tbl:-**

![](images/image4.png)

**e. form_fills:-**

![](images/image5.png)

**f.  question_tbl :-**

![](images/image6.png)

**g.  process_stage_tracking :-**
![](images/image7.png)




	
## BackEnd
**Global variable**

	$connection 6:->** is used to establish connection between database and php.

	**1.	$_POST['request'] = signup_data :-**

		This is a post request to get all data input by the applicant.
	**1)	Data :-**	

		{timezoneOffset,timezonePlace,password,(type=expert),age, gender',country,state(busibud_country=USA),name,email}
	**2)	Function call :-	**

		(i)	helplama_make_profile(request);
		(ii)	insert_phon_num(e_id,contact);
		(iii)	email_send(email,userName);
		(iv)	response_data(e_id,process_id,userName);
	**3)	Return :-**

		{Your profile was created successfully.Email is send for verification}; OR {Email already exists}

**2.	$_POST['request'] = next_btn:-**

	This is a post request to move to the next stage of applicant.
	
	**1)	Data :-	**

		e_id, process_id, userName this all data  will come from the session.
	**2)	Function call :-	**

		(i)	response_data(e_id,process_id,userName);
	**3)	Return :-**

		{next Stage};
					
**3.	$_POST['request'] = login:-**

	Using this post request applicant can login to his already existing profile by giving Email and Password that he set while creating his/her profile.

**1)	Data :-	**

	email,password.
	
**2)	Function call :-	**

	(i)login_agent($email,$pass,$step,$connection6,$google_login);
	(ii)	stage_of_process($process_id);
	(iii)	current_stage($e_id);
	(iv)	get_next_stage($current_stage_id,$process_stage);
	(v)	controler($next_stage_id,$txt,$process_stage_id,'',$e_id);
	
**4)	Return :-**

	{current stage id of applicant}; OR {UserName and Password seems to be wrong}

**4.	$_POST['request'] = session_req:-**

	Using this post request we are checking whether the session is new or already established.
	
	**1)	Data :-	**

		e_id,process_id
	**2)	Function call :-**

	(i)	response_data(e_id,process_id,userName);
	**4)	Return :-**
				{current stage id of applicant};OR {signUp Page}



**5.	$_POST['request'] = forgotPassword:-**

	Using this post request we are updating email's password whenever agents forgot their password then this post request occurs.
	
	**1)Data :-	**

		{'request':'forgotPassword','email':email_val {email address},'reset_link_address':domain_name_host {reset link url password},'support_email_msg':support_email_msg {support email message},'acount_email_msg':acount_email_msg {account email message}}
	**2)Queries :-**
		1. $query = "SELECT * FROM login_tbl WHERE userEmail = '$email'";
		2. $query = "SELECT * FROM helplama_senders_email_data WHERE `domain` = '".$domain_name."'"; {this query is used to get senders email name and url}

			this query is gives us 

				1. $form_email_url=$email_data[1]['email'];
				2. $form_email_name=$email_data[1]['name'];
				3. $support_email=$email_data[1]['support_email'];

	**3)Call another function :-**
		1.$application_obj->email_send($email {email address}, $userFirstName {name of email sender}, $html {format of email which we are sending}, $postVars['subject'] {subject of email},$form_email_url {sender's email },$form_email_name {sender's name}); {this email send function is used send email with required email}
	**4)	Return :-**
				{current stage id of applicant};OR {signUp Page}



	
## Function
 
**1.	helplama_make_profile(request):-**

	This function is a predefined function that is used to make profile of an applicant taking all input data as parameters and insert or update according to the 	data.this function is mainly used for making a profile of the applicant.
	
	**(i) parameter:-**

		request{applicant input}

	**(ii)	Return :-**

			This function will set e_id in session and return e_id.
	
**2.	insert_phon_num(e_id,contact) :-**

	This function is used to insert the phoneNumber of the applicant.
	
	**(i) parameter:-**

		e_id,contact
	**(ii) Query:-**

		(a).  INSERT INTO `helplama_contact_freelancer` (`h_id`, `e_id`, `phoneNum`) VALUES (".$h_id.",".$e_id.",".$phon_num.")"; {This Query will insert phone number with respect to e_id in helplama_contact_freelancer.}

	**(iv)	Return :-**

			Nothing.

**3.	email_send($email,$userName):-**

	This function is used to send mail for verification to the applicant.(we are sending mail using sendgrid)
	
	**(i) parameter:-**
	
		email,userName
	**(ii) Query:-**
	
		No query

	**(iii)	Return :-**
	
		{email send} OR {email not send}

**4.	Response_data(e_id,process_id,userName) :-**

	This function is used to get the message according to the applicant's current or  next stage_id.
	**(i) parameter:-**
	e_id,process_id,userName
	**(ii) Function:-**
		(i).	stage_of_process($process_id)
		(ii).	insert_update_stage($e_id,$process_stage)
		(iii).	get_next_stage($process_stage_id,$process_stage)
		(iv).	controler($next_stage_id,$txt,$process_stage_id,$userName,$e_id);
		(iii) Query:-
				No query
		(iv)	Return :-
				Controller Message{key}
				
**5.	login_agent($email,$pass,$step,$connection6,$google_login):-**

	This function is a predefined function used to get the message whether the step is complete or not.
	
	**(i) parameter:-**
	
	email,password,step(null),connection,googlelogin(null)
	**(ii)	Return :-**
	
			e_step{array}


**6.	stage_of_process($process_id):-**

	This function is used to get all process stage and their details from process_stage_tracking table according to process_id that we are getting from session.
	
	**(i) parameter:-**

		process_id
	**(ii) Query:-**

			SELECT process_stage_tracking.id,auto_next,order_no,name,stage_id,msg_text FROM helplama_applicant_tracking.process_stage_tracking WHERE process_id =? ORDER BY order_no ASC'

	**(iv)	Return :-**

			process_stage(array)

**7.	current_stage($e_id):-**

	This function is used to get the applicant’s current stage id from applicant_stage_tracking table according to e_id coming from session

	**(i) parameter:-**
	e_id
	**(ii) Query:-**
			SELECT * FROM helplama_applicant_tracking.applicant_stage_tracking
	 WHERE e_id=?';
	**(iv)	Return :-**
			crnt_pros_stge_id(string)

**8.	get_next_stage($current_stage_id,$process_stage):-**

	This function is used to decide the applicant’s next stage id from the process_stage array.in this function if it find that current stage id and any of the process_stage_id of process_stage array is same it will pick the next value from the process_stage array as next_stage_id else it will pass the current stage id as next stage id.
	
	**(i) parameter:-**
	
		current_stage_id,process_stage
	**(ii) Query:-**
	
			No query
	**(iv)	Return :-**
	
			 Return array {next_stage_id,auto_next,txt,stage_id}

**9.	controler(next_stage_id,txt,process_stage_id,username,e_id):-**
	
	This function will decide what message or function will show or call on which stage.

	**(i) parameter:-**

	next_stage_id,txt,process_stage_id,username',e_id
	**(ii) Query:-**

			No query
	**(iii) Function :-**

		(i).	form_fill($process_stage_id)
		(ii).	mock_chat_sechedule()
		(iii).	profile_access()
		(iv).	programming_msg($txt)
		(v).	complate_application()
		(vi).	email_varification($txt)
		(vii).	email_verify_msg($txt,$userName,$e_id)
		(viii)	complete_form()
	**(iv)	Return :-**

		Return message{key} OR question answer array of  test form.


**10.	form_fill($process_stage_id):-**

	This function is used to fetch the question answer for the test form from the database according to the process_stage_id.

	**(i) parameter:-**

		process_stage_id
	**(ii) Query:-**

			No query
	**(iii) Function :-**
		(i).	get_form_query_result($process_stage_id,$request)
		(ii).	get_form_details($query_result,$request)
	**(iv)	Return :-**
			 Questions_details{array}

**11.	get_form_query_result($process_stage_id,$request)**

	This function will fetch the question details and answer details from question_tbl and answer_tbl for the test or for the mockchat.for test form it will fetch data from helplama_applicant_tracking database and for mockchat it will fetch data from helplama_mock_chat database.by passing request parameter it is decide whether it  is for applicant form or for mock chat.

	**(i) parameter:-**

		process_stage_id,request
	**(ii) Query:-**

		For applicant_form request this query will run SELECT helplama_applicant_tracking.question_tbl.q_id, helplama_applicant_tracking.question_tbl.q_order,helplama_applicant_tracking.question_tbl.text as questions ,helplama_applicant_tracking.question_tbl.q_type ,helplama_applicant_tracking.answer_tbl.q_id as q_id_ans_tbl,
			 helplama_applicant_tracking.answer_tbl.a_id, helplama_applicant_
		tracking.answer_tbl.a_order,helplama_applicant_tracking.answer_tbl.text as answer FROM helplama_applicant_tracking.question_tbl LEFT JOIN helplama_applicant_tracking.answer_tbl ON(question_tbl.q_id=answer_tbl.q_id and answer_tbl.deleted=0) WHERE process_stage_id=".$form_id." and helplama_applicant_tracking.question_tbl.deleted=0  ORDER by question_tbl.q_order,answer_tbl.a_order ASC";

		For mock_chat request this query will run

		SELECT helplama_test_question_tbl.q_id,helplama_test_question_tbl.text as
		questions,helplama_test_question_tbl.q_order,helplama_test_answer_tbl.a_id,helplama_test_answer_tbl.text as ans,helplama_test_answer_tbl.q_id as q_id_ans_tbl,helplama_test_answer_tbl.a_order,helplama_test_next_question_tbl.next_q_id FROM helplama_mock_chat.helplama_test_question_tbl LEFT JOIN helplama_mock_chat.helplama_test_answer_tbl on(helplama_test_question_tbl.q_id=helplama_test_answer_tbl.q_id AND helplama_test_answer_tbl.deleted=0) INNER JOIN helplama_mock_chat.helplama_test_next_question_tbl on(helplama_test_next_question_tbl.a_id=helplama_test_answer_tbl.a_id) WHERE helplama_test_question_tbl.`deleted`=0 AND seed_q_id=".$form_id." ORDER by helplama_test_question_tbl.`q_order`,helplama_test_answer_tbl.a_order ASC";

	**(iv)	Return :-**
		 q_id_array{array}
		EX. {"que_array":[" heelo process 1 pa testing of formm","hellp radio
		 ques","checkbox","textmessage","textarea","file"],
		"ans_array":["radio pa testing","hanii its testing","1","2"],
		"que_ans_array":[[],[0,1],[2,3],[],[],[]],
		"que_order_array":[0,1,2,4,5,6],
		"que_ids":["1","2","3","4","5","6"],
		"ans_ids":[1,2,3,4],
		"que_type":["1","2","3","4","5","6"],
		"All_linking_ans":[]}

**12.	get_form_details($query_result,$request) :-**
	This function is used to remove the duplicates value from the q_id_array and arrange the result in key value form.

	**(i) parameter:-**

	query_result{q_id_array},request
	**(ii) Query:-**

			No query
	(**iv)	Return :-**
			 Que_ans_data{array}

**13.	insert_update_stage($e_id,$process_stage):-**
		
		This function is used to update or insert the process_stage_id according to the e_id in the applicant_stage_tracking table. And this method is used update 			database for sending emails and check for next email text according to stage we take form database id and use another function to take text for email and 			update database after sending email.
		
		**(i) parameter:-**
		
		e_id, process_stage
		**(ii) Query:-**
		
			This query will check whether the process_stage_id exists in the table or not. 
		
			(i).	SELECT * FROM helplama_applicant_tracking.applicant_stage_tracking
			 WHERE e_id=?';
			If the above query gives any result then we run this query to update the process_stage_id. 
			(ii).	UPDATE helplama_applicant_tracking.applicant_stage_tracking SET
			 process_stage_id=? where e_id=?';
			If the above query doesn't give any result then we insert process_stage_id with respect to e_id in the table. 
			(iii).	INSERT INTO helplama_applicant_tracking.applicant_stage_tracking 
			(e_id,process_stage_id) VALUES(?,?)';
			(iv) . 'SELECT * FROM helplama_applicant_tracking.auto_next_email WHERE e_id=? AND process_stage_id=?'; (This database table we made for maintaining email is sent or not for particular stage to particular agent whoever is filling form.  )


	**(iii) Function :-**

			 (i).  get_next_stage($crnt_pros_stge_id,$process_stage);
			(ii). $manage_stage_data->get_email_text($process_stage_id); (Calling another function to get email text for stage according to id this function defines in 				another file called /./app/helplama_dashboard/dash/helplama_applicant_tracking/manage_process_stage.php)
			(iii). send_auto_email($e_id {agent id}, $process_stage_id {stage id for process}, $email_text_val['text'] {email text}); (this function is used for 					updating database for sending email track and and this function is also sending emails).
	**(iv) Return:-**
	
			process_stage_id(string)


**14.	mock_chat_sechedule():-**

		This function will return a key moct_chat to display mock chat message. 		
**15.	profile_access():-**

	This function will return a key profile_access to display Profile access message.

**16.	programming_msg($txt)**

	This function will return a key programming message to display Programming message.
	
**17.	complate_application():-**

	This function will return a key complete_application to display message for  application completion.

**18.	email_varification($txt)**

	This function will send an icon for verification.

**19.	email_verify_msg($txt,$userName,$e_id):-**
	This function will return a key whether the email of the applicant is verified or not.	
**(i).	Parameter:-**

	userName, e_id, txt
**(ii).	 Function :-**

	(i).get_verification_status($e_id);
	
**(iii).	Return :-**

	message(key)

**20.	complete_form():-**

	This function will return a form completion key.

**21.	get_verification_status($e_id):-**

	This function will check whether the applicant email is verified or not using e_id.
	
	**(i). Parameter :-**
	
		e_id
		
	**(ii). Query:-**
	
		SELECT verified FROM helplama_experts WHERE id =?';
		
	**(iii). Return :-**
	
		verified(boolean)


**22.	insert_data() :-**

	This function will call its child function according to the question_type.
	
	**a.	Function :-**
	
		(i).	insert_text()
		(ii).	insert_radio_ans()
		(iii).	insert_ckecbox_ans()
		
	**b. 	Return:-**
		{saved}

**22.	insert_text() :-**

	This function is used to insert answers of a text question type.

	**a.	Table affect:-**
		(i).	fiom_fills

	**a.	Query :-**
		This query will run to check whether the answer or file is already there for a particular question of this e_id’s applicant.if it finds any result it will open and update that file with that  answer.  
		(i).	SELECT * from helplama_applicant_tracking.form_fills where e_id=? and q_id=?';
		
		If the above query doesn't return any result then this query will run to insert the data in the table.
		(ii).	INSERT INTO helplama_applicant_tracking.form_fills(e_id,q_id,file) VALUES (?,?,?)';
		
	**b. 	Return:-**
	
	{saved}
	
**23.	insert_radio_ans() :-**

	This function is used to insert answers of a radio question type.
	
	**a.	Table affect:-**
		(i).	fiom_fills

	**a.	Query :-**
	
		This query will run to check whether the answer is already there for a particular question of this e_id’s applicant.
		(i).	SELECT * from helplama_applicant_tracking.form_fills where e_id=? and q_id=?';
			If the above query doesn't return any result then this query will run to insert the data in the table.
		(ii).	INSERT INTO helplama_applicant_tracking.form_fills
		(e_id,q_id,option_id) VALUES (?,?,?)';
		.if select query finds any result it will update the answer for that particular question.  
		(iii)	UPDATE helplama_applicant_tracking.form_fills SET option_id=? Where
		 e_id=? and q_id=? ';
		 
	**b. 	Return:-**

		{saved}
		
**24.	insert_ckecbox_ans() :-**

	This function is used to insert answers of a checkbox question type.
	
	**a.	Table affect:-**
	
		(i).	fiom_fills

		a.	Query :-
	This query will run to check whether the answer is already there for a particular question of this e_id’s applicant.
			(i).	SELECT * from helplama_applicant_tracking.form_fills where e_id=? 
	and q_id=? and option_id=?';
	If the above query doesn't return any result then this query will run to insert the data in the table.
	(ii).	INSERT INTO helplama_applicant_tracking.form_fills
	(e_id,q_id,option_id) VALUES (?,?,?)';
	.if select query finds any result it will update the answer for that particular question.  
	(iii)	UPDATE helplama_applicant_tracking.form_fills SET deleted=? Where
	 e_id=? and q_id=? and option_id=?';
	 
	**b. 	Return:-**
	
		{saved}

**25.	insert_file() :-**

	This function is used to upload the file that contains question answers for a test in the Directory.if it didn't find any directory it will make a directory to save file.
 
 
**26. send_auto_email($e_id {agent id}, $process_stage_id {stage id from where agent reached}, $email_text {email text}):-**

		This function is used to update database for sending emails and calling another function to send emails.
		
		**(i) parameter:-**
		
			$e_id {agent id}, $process_stage_id {stage id from where agent reached}, $email_text {email text}
		**(ii) Query:-**
		
			This query will insert new entry in auto_next_email table and use SELECT query to get agent username and user email. 
				(i).	INSERT INTO helplama_applicant_tracking.auto_next_email (e_id,process_stage_id) VALUES(?,?);{this query is used to inset new entry into table which will track email is already sent for particular stage to particular agent}
				(ii).	SELECT `userFullName`,`userEmail` FROM login_tbl WHERE `customerID` IN (SELECT helplama_experts.login_id FROM helplama_experts WHERE id=?);
				{this query is used to get agent user name and user email which is required for sening emails}
				If the above query doesn't give any result then we insert process_stage_id with respect to e_id in the table. 


		**(iii) Function :-**
			(i).	$this->email_send($email, $userName, $html, $sub); {this function is used to send email to agent depends upon parameters. it is used to send email for every stage changes for agents when agents are going to fill applicant forms proccess.}
			(ii). $sender_email_data = $this->get_domin_sender_email($_SERVER['HTTP_HOST']); {this function is used to get sender email and name}
		**(iv) Return:-**
			No retun Calling another functions


**27. get_logo_url($domain_name {we pass domain name of page where from we requested this request}):-**

		This function is used to get logo url from database according to passed parameter $domain name.
		
		**(i) parameter:-**
		
			$domain_name {we pass domain name of page where from we requested this request}
		**(ii) Query:-**
		
			This query will insert new entry in auto_next_email table and use SELECT query to get agent username and user email. 
				(i).$sql= 'SELECT `logo_url` FROM `helplama_projects_logos` WHERE domain = "'.$domain_name.'"';
					This query is used to get logo url according to domain name

		**(iii) Return:-**
				logo_url;
					it is logo url which is used to show in Page


**28. get_domin_sender_email($domain_name {we pass domain name of page where from we requested this request}):-**

		This function is used to get email , name and support email from database according to passed parameter $domain name.
		
		**(i) parameter:-**
		
			$domain_name {we pass domain name of page where from we requested this request}
		**(ii) Query:-**
		
			This query will select data for senders's email , name and support email according to domain name. 
				(i).$sql= 'SELECT * FROM helplama_senders_email_data WHERE `domain` = '".$domain_name."'';
					This query is used to get email , name and support email according to domain name from helplama_senders_email_data data.

		**(iii) Return:-**
				email , name and support email;
					$all_data['email'] = $email_data[1]['email'];
			        $all_data['name'] = $email_data[1]['name'];
			        $all_data['support_email'] = $email_data[1]['support_email'];


















































































