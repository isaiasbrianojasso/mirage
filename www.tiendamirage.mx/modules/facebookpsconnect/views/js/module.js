/*
 * 2003-2019 Business Tech
 *
 *  @author    Business Tech SARL
 *  @copyright 2003-2019 Business Tech SARL
 */

// declare main object of module
var FpcModule = function(sName) {
	// set name
	this.name = sName;

	// set name
	this.oldVersion = false;

	// set translated js msgs
	this.msgs = {};

	// stock error array
	this.aError = [];

	// set url of admin img
	this.sImgUrl = '';

	// set url of module's web service
	this.sWebService = '';

	// set response
	this.response = null;

	// set this in obj context
	var oThis = this;

	/*
	 * show() method show effect and assign HTML in
	 * User: Business Tech (www.businesstech.fr) - Contact: http://www.businesstech.fr/en/contact-us
	 * @param string sId : container to show in
	 * @param string sHtml : HTML to display
	 * @return -
	 */
	this.show = function(sId, sHtml) {
		$("#" + sId).html(sHtml).css('style', 'none');
		$("#" + sId).show('fast');
	};

	/*
	 * hide() method hide effect and delete html
	 * User: Business Tech (www.businesstech.fr) - Contact: http://www.businesstech.fr/en/contact-us
	 * @param string sId : container to hide in
	 * @return -
	 */
	this.hide = function(sId) {
		$("#" + sId).hide('fast', function() {
				$("#" + sId).html('');
			}
		);
	};

	/*
	 * form() method check all fields of current form and execute : XHR or submit => used for update all admin config
	 * User: Business Tech (www.businesstech.fr) - Contact: http://www.businesstech.fr/en/contact-us
	 * @see ajax
	 * @param string sForm : form
	 * @param string sURI : query params used for XHR
	 * @param string sRequestParam : param action and type in order to send with post mode
	 * @param string sToDisplay :
	 * @param string sToHide : force to hide specific ID
	 * @param bool bSubmit : used only for sending main form
	 * @param bool bFancyBox : used only for fancybox in xhr
	 * @param string sCallback :
	 * @param string sErrorType :
	 * @param string sLoadBar :
	 * @return string : HTML returned by smarty
	 */
	this.form = function(sForm, sURI, sRequestParam, sToDisplay, sToHide, bSubmit, bFancyBox, sCallback, sErrorType, sLoadBar) {
		// set loading bar
		if (sLoadBar) {
			$('#'+sLoadBar).show();
		}

		// set return validation
		var aError = [];

		// get all fields of form
		var fields = $("#" + sForm).serializeArray();

		// set counter
		var iCounter = 0;

		// set bIsError
		var bIsError = false;

		// check element form
		jQuery.each(fields, function(i, field) {
			bIsError = false;

			switch(field.name) {
				case 'id' :
					if (field.value == '') {
						oThis.aError[iCounter] = oThis.msgs.id;
						bIsError = true;
					}
					break;
				case 'secret' :
					if (field.value == '') {
						oThis.aError[iCounter] = oThis.msgs.secret;
						bIsError = true;
					}
					break;
				case 'callback' :
					if (field.value == '') {
						oThis.aError[iCounter] = oThis.msgs.callback;
						bIsError = true;
					}
					break;
				case 'scope' :
					if (field.value == '') {
						oThis.aError[iCounter] = oThis.msgs.scope;
						bIsError = true;
					}
					break;
				case 'developerKey' :
					if (field.value == '') {
						oThis.aError[iCounter] = oThis.msgs.developerKey;
						bIsError = true;
					}
					break;
				case 'socialEmail' :
					if (field.value == '') {
						oThis.aError[iCounter] = oThis.msgs.socialEmail;
						bIsError = true;
					}
					break;
                case 'fbpscDefaultConnectText' :
                    if (field.value == '') {
                        oThis.aError[iCounter] = oThis.msgs.defaultText;
                        bIsError = true;
                    }
	                break;
				case 'fbpscPrefixCode' :
					if (field.value == '' && $('input:radio[name="fbpscEnableVoucher"]').val() == 'true') {
						oThis.aError[iCounter] = oThis.msgs.prefixCode;
						bIsError = true;
					}
					break;
				case 'fbpscApiRequestType' :
					if (field.value == '') {
						oThis.aError[iCounter] = oThis.msgs.apiType;
						bIsError = true;
					}
					break;
				case 'fbpscHtmlElement' :
					if (field.value == '') {
						oThis.aError[iCounter] = oThis.msgs.htmlElement;
						bIsError = true;
					}
					break;
				case 'fbpscPositionName' :
					if (field.value == '') {
						oThis.aError[iCounter] = oThis.msgs.positionName;
						bIsError = true;
					}
					break;
				case 'sCssPaddingTop' :
					if (field.value == '' || $.isNumeric( field.value ) == false) {
						oThis.aError[iCounter] = oThis.msgs.padding;
						bIsError = true;
					}
					break;
				case 'sCssPaddingRight' :
					if (field.value == '' || $.isNumeric( field.value ) == false ) {
						oThis.aError[iCounter] = oThis.msgs.padding;
						bIsError = true;
					}
					break;
				case 'sCssPaddingBottom' :
					if (field.value == '' || $.isNumeric( field.value ) == false ) {
						oThis.aError[iCounter] = oThis.msgs.padding;
						bIsError = true;
					}
					break;
				case 'sCssPaddingLeft' :
					if (field.value == '' || $.isNumeric( field.value ) == false ) {
						oThis.aError[iCounter] = oThis.msgs.padding;
						bIsError = true;
					}
					break;
				case 'sCssMarginTop' :
					if (field.value == '' || $.isNumeric( field.value ) == false) {
						oThis.aError[iCounter] = oThis.msgs.margin;
						bIsError = true;
					}
					break;
				case 'sCssMarginRight' :
					if (field.value == '' || $.isNumeric( field.value ) == false ) {
						oThis.aError[iCounter] = oThis.msgs.margin;
						bIsError = true;
					}
					break;
				case 'sCssMarginBottom' :
					if (field.value == '' || $.isNumeric( field.value ) == false ) {
						oThis.aError[iCounter] = oThis.msgs.margin;
						bIsError = true;
					}
					break;
				case 'sCssMarginLeft' :
					if (field.value == '' || $.isNumeric( field.value ) == false ) {
						oThis.aError[iCounter] = oThis.msgs.margin;
						bIsError = true;
					}
					break;
				default:
					break;
			}

			if (($('input[name="' + field.name + '"]') != undefined || $('textarea[name="' + field.name + '"]') != undefined || $('select[name="' + field.name + '"]').length != undefined) && bIsError == true) {
				if ($('input[name="' + field.name + '"]').length != 0) {
					$('input[name="' + field.name + '"]').parent().addClass('has-error has-feedback');
					$('input[name="' + field.name + '"]').append('<span class="icon-remove-sign"></span>');
				}
				if ($('textarea[name="' + field.name + '"]').length != 0) {
					$('textarea[name="' + field.name + '"]').parent().addClass('has-error has-feedback');
					$('textarea[name="' + field.name + '"]').append('<span class="icon-remove-sign"></span>');
				}
				if ($('select[name="' + field.name + '"]').length != 0) {
					$('select[name="' + field.name + '"]').parent().addClass('has-error has-feedback');
					$('select[name="' + field.name + '"]').append('<span class="icon-remove-sign"></span>');
				}
				++iCounter;
			}
		});

		if (oThis.aError.length == 0 && !bIsError) {
			// use case - Ajax request
			if (bSubmit == undefined || bSubmit == null || !bSubmit) {
				if (sLoadBar && sToHide != null) {
					oThis.hide(sToHide, true);
				}

				// format object of fields in string to execute Ajax request
				var sFormParams = $.param(fields);

				if (sRequestParam != null && sRequestParam != '') {
					sFormParams = sRequestParam + '&' + sFormParams;
				}

				// execute Ajax request
				this.ajax(sURI, sFormParams, sToDisplay, sToHide, bFancyBox, null, sLoadBar);

				return true;
			}
			// use case - send form
			else {
				// hide loading bar
				if (sLoadBar) {
					$('#'+sLoadBar).hide();
				}
				document.forms[sForm].submit();
				return true;
			}
		}
		else {
			$('#'+sLoadBar).hide();
		}
		// display errors
		this.displayError(sErrorType);

		return false;
	};

	/*
	 * ajax() method execute XHR
	 * User: Business Tech (www.businesstech.fr) - Contact: http://www.businesstech.fr/en/contact-us
	 * @param string sURI : query params used for XHR
	 * @param string sParams :
	 * @param string sToShow :
	 * @param string sToHide :
	 * @param bool bFancyBox : used only for fancybox in xhr
	 * @param bool bFancyBoxActivity : used only for fancybox in xhr
	 * @param string sLoadBar : used only for loading
	 * @return string : HTML returned by smarty
	 */
this.ajax = function(sURI, sParams, sToShow, sToHide, bFancyBox, bFancyBoxActivity, sLoadBar) {
		if(bFancyBox && bFancyBoxActivity != false) {
			//$.fancybox.showActivity();
		}

		sParams = 'sMode=xhr' + ((sParams == null || sParams == undefined) ? '' : '&' + sParams) ;

		// configure XHR
		$.ajax({
			type : 'POST',
			url : sURI,
			data : sParams,
			dataType : 'html',
			success: function(data) {
				// hide loading bar
				if (sLoadBar) {
					$('#'+sLoadBar).hide();
				}
				if(bFancyBox) {
					// update fancybox content
					$.fancybox(data);

					// use case - update only widget list
					if (sToShow == oThis.name + 'ConnectorList') {
						oThis.ajax('' + sURI, 'sAction=display&sType=connectors', '' + sToShow + '', '' + sToHide + '');
					}
					// use case - update widget list and hook list
					else if (sToShow == oThis.name + 'HookList') {
						sToShow = sToHide = oThis.name + 'ConnectorList';
						oThis.ajax('' + sURI + 'connectors', 'sAction=display&sType=connectors', '' + sToShow + '', '' + sToHide + '');
						sToShow = sToHide = oThis.name + 'HookList';
						oThis.ajax('' + sURI + 'hooks', 'sAction=display&sType=hooks', '' + sToShow + '', '' + sToHide + '');
					}
					else if (sToShow == oThis.name + 'HookAdvanced')
					{
						oThis.ajax('' + sURI, 'sAction=display&sType=hookAdvanced', '' + sToShow + '', '' + sToHide + '');
					}
					else if (sToShow == oThis.name + 'ShortCode')
					{
						oThis.ajax('' + sURI, 'sAction=display&sType=shortCode', '' + sToShow + '', '' + sToHide + '');
					}
				}
				else if (sToShow != null && sToHide != null) {
					// same hide and show
					if (sToShow == sToHide) {
						oThis.hide('fast');
						$('#' + sToHide).hide('fast');
						$('#' + sToHide).empty();
						setTimeout('', 1000);
						oThis.show(sToShow, data);
					}
					else {
						oThis.hide(sToHide);
						setTimeout('', 1000);
						oThis.show(sToShow, data);
					}
				}
				else if (sToShow != null) {
					oThis.show(sToShow, data);
				}
				else if (sToHide != null) {
					oThis.hide(sToHide);
				}
				else {
					oThis.response = data;
				}
			},
			error: function(xhr, ajaxOptions, thrownError) {
				$("#" + oThis.name + "FormError").addClass('alert error');
				oThis.show("#" + oThis.name + "FormError", '<h3>internal error</h3>');
			}
		});
	};

	/*
	 * displayError() method display errors
	 * User: Business Tech (www.businesstech.fr) - Contact: http://www.businesstech.fr/en/contact-us
	 * @param string sType : type of container
	 * @return bool
	 */
	this.displayError = function(sType) {
		if (oThis.aError.length != 0) {
			var sError = '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">×</button><ul class="list-unstyled">';
			for (var i = 0; i < oThis.aError.length;++i) {
				sError += '<li>' + oThis.aError[i] + '</li>';
			}
			sError += '</ul></div>'

			$("#" + oThis.name + sType + "Error").html(sError);
			$("#" + oThis.name + sType + "Error").slideDown();

			// flush errors
			oThis.aError = [];

			return false;
		}
	};

	/**
	 * changeSelect() method displays or hide related option form
	 *
	 * @param string sId : type of container
	 * @param mixed mDestId
	 * @param string sDestId2
	 * @param string sType of second dest id
	 * @param bool bForce
	 * @param bool mVal
	 */
	this.changeSelect = function(sId, mDestId, sDestId2, sDestIdToHide, bForce, mVal) {
		if (bForce) {
			if (typeof mDestId == 'string') {
				mDestId = [mDestId];
			}

			for (var i = 0; i < mDestId.length; ++i) {
				if (mVal) {
					$("#" + mDestId[i]).fadeIn('fast', function() {$("#" + mDestId[i]).css('display', 'block')});
				}
				else {
					$("#" + mDestId[i]).fadeOut('fast');
				}
			}
		}
		else {
			$("#" + sId).bind('change', function (event){
				$("#" + sId + " input:checked").each(function (){
					switch ($(this).val()) {
						case 'true' :
							// display option features
							$("#" + sDestId).fadeIn('fast', function() {$("#" + sDestId).css('display', 'block')});
							break;
						default:
							// hide option features
							$("#" + sDestId).fadeOut('fast');

							// set to false
							if (sDestId2 && sDestIdToHide) {
								$("#" + sDestId2 + " input").each(function (){
										switch ($(this).val()) {
											case 'false' :
												$(this).attr('checked', 'checked');
												// hide option features
												$("#" + sDestIdToHide).fadeOut('fast');
												break;
											default:
												$(this).attr('checked', '');
												break;
										}
									}
								);
							}
							break;
					}
				});
			});
		}
	};

	/**
	 * selectAll() method select / deselect all checkbox
	 *
	 * @param string sId : type of container
	 * @param string sCible : all checkbox to process
	 */
	this.selectAll = function(sCible, sType){
		if (sType == 'check') {
			$(sCible).attr('checked', true);
		}
		else{
			$(sCible).attr('checked', false);
		}
	};

	/*
	 * updateHook() method verify all childnodes of hook list and determine position to display widget in hook
	 * User: Business Tech (www.businesstech.fr)
	 * @param string sURI : query params used for XHR
	 * @param string sHookList :
	 * @param string sToShow :
	 * @param string sToHide :
	 * @param bool bFancyBox : used only for fancybox in xhr
	 * @return string : HTML returned by smarty
	 */
	this.updateHook = function(sURI, sHookList, sToShow, sToHide, bFancyBox) {
		var sList = '';

		if ($("#" + sHookList + " li").length != 0) {
			var aConnectorId = [];
			$("#" + sHookList + " li").each(function(i, elt) {
					aConnectorId[i] = elt.id;
				}
			);
			sList = aConnectorId.toString();
		}
		this.ajax(sURI, 'sConnectorList=' + sList, sToShow, sToHide, bFancyBox);
	};

	/*
	 * draggableConnector() method set draggable
	 * User: Business Tech (www.businesstech.fr)
	 * @param obj Current HTML elt
	 * @return -
	 */
	this.draggableConnector = function() {
		// declare draggable elts
		$("#" + oThis.name + "DraggableConnector li").draggable({
			revert : "invalid"
		});

		// declare droppable elt - only drop elt in this tag
		$("#" + oThis.name + "DroppableConnector ul").droppable({
			drop : function(event, ui) {
				// append draggable elt
				$("#" + oThis.name + "DroppableConnector ul").append(ui.draggable);
				// set css and deactivate drag
				$(ui.draggable).css({position:"relative", top:"0px", left:"0px", display : "block"})
					.draggable("disable")
					.css({opacity : 1})
					.addClass('fbpscsortli', 'ui-state-default', 'pull-left', 'col-xs-8')

				// append img and click evt only in no already added img
				var bFound = $(ui.draggable).find('span.' + oThis.name + 'Garbage');

				// use case - add img and click evt in no img case
				if (bFound.length == 0) {

					//Init html content
					var oCurrentDragableA = $(ui.draggable).html();
					console.log(oCurrentDragableA);
					var oGarbage = '<span class="pull-left btn btn-default btn-mini ' + oThis.name + 'Garbage"> <i class="fa fa-trash"/></span>';

					$(ui.draggable).html();
					$(ui.draggable).html('<div class="row" id="fbpsc" ><div class="col-xs-10">' + oCurrentDragableA + '</div><div class="col-xs-2">' + oGarbage + ' </div></div>');
					$(ui.draggable).bind('click', function() {
							oThis.deleteConnector(this)
						}
					);
				}
			}
		});
	};

	/*
	 * sortableConnector() method set sortable Connector
	 * User: Business Tech (www.businesstech.fr)
	 * @param obj Current HTML elt
	 * @return -
	 */
	this.sortableConnector = function() {
		// set sortable elt
		$( "#" + oThis.name + "Sortable" ).sortable();
		$( "#" + oThis.name + "Sortable" ).disableSelection();
	};

	/*
	 * deleteConnector() method delete added Connector in hook form
	 * User: Business Tech (www.businesstech.fr)
	 * @param obj Current HTML elt
	 * @return -
	 */
	this.deleteConnector = function(oElt) {
		$(oElt).find('button.' + oThis.name + 'Garbage').remove();
		$("#" + oThis.name + "DraggableConnector ul").append($(oElt).removeClass('fbpscsortli').draggable('enable').draggable('option', 'revert' , 'invalid').addClass('fbpscdragli'));
	};

	/*
	 * getCharts() method get the charts for connect
	 * User: Business Tech (www.businesstech.fr) - Contact: http://www.businesstech.fr/en/contact-us
	 * @param string sElem : Canvas element to plug the charts
	 * @param array aData : data to manage the charts
	 * @param array aLabel : list of label to manage
	 * @param array aColor : color for each element of the charts
	 * @param string sTitle : the graph title
	 */
	this.getCharts = function(sElem, aData, aLabel, aColor, sTitle) {

		//For filter charts
		aData = {
			datasets: [{
				data : aData,
				backgroundColor: aColor
			}],
			// These labels appear in the legend and in the tooltips when hovering different arcs
			labels: aLabel
		};

		var oDoughnutChart = new Chart(sElem, {
			type: 'pie',
			data: aData,
			options: {
				legend : {
					position : 'bottom'
				},
				title : {
					display : true,
					position : 'top',
					text: sTitle,
					fontSize : 14
				}
			}
		});
	};


	/*
	 * hide() method hide effect and delete html
	 * User: Business Tech (www.businesstech.fr) - Contact: http://www.businesstech.fr/en/contact-us
	 * @param string sId : container to hide in
	 * @return -
	 */
	this.hide = function(sId) {
		$("#" + sId).hide('fast', function() {
				$("#" + sId).html('');
			}
		);
	};

	/**
	 * getBulkCheckBox() method get all checkbox for one element
	 *
	 * @param array aParams
	 * @param json
	 */
	this.getBulkCheckBox = function(sFieldName)
	{
		var iElemId = [];

		$('input:checked[name="' + sFieldName + '"]').each(function() {
			iElemId.push($(this).val());
		})

		if (iElemId != null)
			return iElemId;
		else
			return iElemId = 1;

	}

	/**
	 * getContentFromSwitch() method return a cotent according to the switch value
	 */
	this.getContentFromSwitch = function(sIdElemOn, sElem){
		if ($("#"+ sIdElemOn).is(':checked') == true){
			$("#" + sElem).show();
		}
		else
		{
			$("#" + sElem).hide();
		}
	};

	/**
	 * getConnectors() method return visual for connectors
	 * @param sShortCodeName
	 */
	this.getConnectors = function(sSelector, sShortCodeName){

		this.ajax(this.sWebService, 'sAction=display&sType=shortCode&sShortCodeName=' + sShortCodeName, 'sl_connector_'+ sSelector, null, null, null, null);
	};

};