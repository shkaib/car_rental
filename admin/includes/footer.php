<!-- Main page footer -->
		<footer class="container">
			<p><?php echo ADMIN_FOOTER;?></p>
			<a href="#top" class="btn btn-primary btn-flat pull-right">Top &uarr;</a>
		</footer>
		<!-- /Main page footer -->
		
		<!-- Scripts -->
		<script src="<?php echo SITE_URL;?>js/navigation.js"></script>

		<!-- Bootstrap scripts -->
		<!--
		<script src="<?php echo SITE_URL;?>js/bootstrap/bootstrap-tooltip.js"></script>
		<script src="<?php echo SITE_URL;?>js/bootstrap/bootstrap-dropdown.js"></script>
		<script src="<?php echo SITE_URL;?>js/bootstrap/bootstrap-button.js"></script>
		<script src="<?php echo SITE_URL;?>js/bootstrap/bootstrap-alert.js"></script>
		<script src="<?php echo SITE_URL;?>js/bootstrap/bootstrap-popover.js"></script>
		<script src="<?php echo SITE_URL;?>js/bootstrap/bootstrap-collapse.js"></script>
		<script src="<?php echo SITE_URL;?>js/bootstrap/bootstrap-transition.js"></script>
		-->
		<script src="<?php echo SITE_URL;?>js/bootstrap/bootstrap.js"></script>
		
        <script src="<?php echo SITE_URL;?>js/plugins/fileupload/bootstrap-fileupload.js"></script>
		<script src="<?php echo SITE_URL;?>js/plugins/inputmask/bootstrap-inputmask.js"></script>
        
		<!-- Block TODO list -->
		<script>
			$(document).ready(function() {
				
				$('.todo-block input[type="checkbox"]').click(function(){
					$(this).closest('tr').toggleClass('done');
				});
				$('.todo-block input[type="checkbox"]:checked').closest('tr').addClass('done');
				
			});
		</script>
		
		<!-- jQuery Visualize -->
		<!--[if lte IE 8]>
			<script language="javascript" type="text/javascript" src="js/plugins/visualize/excanvas.js"></script>
		<![endif]-->
		<script src="<?php echo SITE_URL;?>js/plugins/visualize/jquery.visualize.min.js"></script>
		
		<script>
			$(document).ready(function() {
			
				var chartWidth = $(('.chart')).parent().width()*0.9;
				
				$('.chart').hide().visualize({
					type: 'pie',
					width: chartWidth,
					height: chartWidth,
					colors: ['#389abe','#fa9300','#6b9b20','#d43f3f','#8960a7','#33363b','#b29559','#6bd5b1','#66c9ee'],
					lineDots: 'double',
					interaction: false
				});
			
			});
		</script>
		<!-- jQuery Flot Charts -->
		<!--[if lte IE 8]>
			<script language="javascript" type="text/javascript" src="<?php echo SITE_URL;?>js/plugins/flot/excanvas.min.js"></script>
		<![endif]-->
		
		
		<!-- jQuery jGrowl -->
        <?php
				$GetActiveMessage = $objCommon->displayMessage_2();
				if($GetActiveMessage!=''){
				?>
		<script type="text/javascript" src="<?php echo SITE_URL;?>js/plugins/jGrowl/jquery.jgrowl.js"></script>
        
    <script type="text/javascript">
	
    $(document).ready(function(){
				
				// This value can be true, false or a function to be used as a callback when the closer is clciked
				
				
				$.jGrowl("<?php echo $GetActiveMessage; ?> ", { 
					theme: 'success',
					speed: 'slow'
				});
	});
	<?php } ?>				</script>
		<script src="<?php echo SITE_URL;?>js/plugins/dataTables/jquery.datatables.min.js"></script>
		<script>
			/* Default class modification */
			$.extend( $.fn.dataTableExt.oStdClasses, {
				"sWrapper": "dataTables_wrapper form-inline"
			} );
			
			/* API method to get paging information */
			$.fn.dataTableExt.oApi.fnPagingInfo = function ( oSettings )
			{
				return {
					"iStart":         oSettings._iDisplayStart,
					"iEnd":           oSettings.fnDisplayEnd(),
					"iLength":        oSettings._iDisplayLength,
					"iTotal":         oSettings.fnRecordsTotal(),
					"iFilteredTotal": oSettings.fnRecordsDisplay(),
					"iPage":          Math.ceil( oSettings._iDisplayStart / oSettings._iDisplayLength ),
					"iTotalPages":    Math.ceil( oSettings.fnRecordsDisplay() / oSettings._iDisplayLength )
				};
			}
			
			/* Bootstrap style pagination control */
			$.extend( $.fn.dataTableExt.oPagination, {
				"bootstrap": {
					"fnInit": function( oSettings, nPaging, fnDraw ) {
						var oLang = oSettings.oLanguage.oPaginate;
						var fnClickHandler = function ( e ) {
							e.preventDefault();
							if ( oSettings.oApi._fnPageChange(oSettings, e.data.action) ) {
								fnDraw( oSettings );
							}
						};
						
						$(nPaging).addClass('pagination').append(
							'<ul>'+
								'<li class="prev disabled"><a href="#">&larr; '+oLang.sPrevious+'</a></li>'+
								'<li class="next disabled"><a href="#">'+oLang.sNext+' &rarr; </a></li>'+
							'</ul>'
						);
						var els = $('a', nPaging);
						$(els[0]).bind( 'click.DT', { action: "previous" }, fnClickHandler );
						$(els[1]).bind( 'click.DT', { action: "next" }, fnClickHandler );
					},
					
					"fnUpdate": function ( oSettings, fnDraw ) {
						var iListLength = 5;
						var oPaging = oSettings.oInstance.fnPagingInfo();
						var an = oSettings.aanFeatures.p;
						var i, j, sClass, iStart, iEnd, iHalf=Math.floor(iListLength/2);
						
						if ( oPaging.iTotalPages < iListLength) {
							iStart = 1;
							iEnd = oPaging.iTotalPages;
						}
						else if ( oPaging.iPage <= iHalf ) {
							iStart = 1;
							iEnd = iListLength;
						} else if ( oPaging.iPage >= (oPaging.iTotalPages-iHalf) ) {
							iStart = oPaging.iTotalPages - iListLength + 1;
							iEnd = oPaging.iTotalPages;
						} else {
							iStart = oPaging.iPage - iHalf + 1;
							iEnd = iStart + iListLength - 1;
						}
						
						for ( i=0, iLen=an.length ; i<iLen ; i++ ) {
							// Remove the middle elements
							$('li:gt(0)', an[i]).filter(':not(:last)').remove();
							
							// Add the new list items and their event handlers
							for ( j=iStart ; j<=iEnd ; j++ ) {
								sClass = (j==oPaging.iPage+1) ? 'class="active"' : '';
								$('<li '+sClass+'><a href="#">'+j+'</a></li>')
									.insertBefore( $('li:last', an[i])[0] )
									.bind('click', function (e) {
										e.preventDefault();
										oSettings._iDisplayStart = (parseInt($('a', this).text(),10)-1) * oPaging.iLength;
										fnDraw( oSettings );
									} );
							}
							
							// Add / remove disabled classes from the static elements
							if ( oPaging.iPage === 0 ) {
								$('li:first', an[i]).addClass('disabled');
							} else {
								$('li:first', an[i]).removeClass('disabled');
							}
							
							if ( oPaging.iPage === oPaging.iTotalPages-1 || oPaging.iTotalPages === 0 ) {
								$('li:last', an[i]).addClass('disabled');
							} else {
								$('li:last', an[i]).removeClass('disabled');
							}
						}
					}
				}
			});
			
			/* Show/hide table column */
			function dtShowHideCol( iCol ) {
				var oTable = $('#example-2').dataTable();
				var bVis = oTable.fnSettings().aoColumns[iCol].bVisible;
				oTable.fnSetColumnVis( iCol, bVis ? false : true );
			};
			
			/* Table #example */
			$(document).ready(function() {
				$('.datatable').dataTable( {
					"sDom": "<'row-fluid'<'span6'l><'span6'f>r>t<'row-fluid'<'span6'i><'span6'p>>",
					"sPaginationType": "bootstrap",
					"oLanguage": {
						"sLengthMenu": "_MENU_ records per page"
					}
				});
				$('.datatable-controls').on('click','li input',function(){
					dtShowHideCol( $(this).val() );
				})
			});
			</script>
            <!-- Datepicker -->
		<script src="<?php echo SITE_URL;?>js/plugins/datepicker/bootstrap-datepicker.js"></script>
		<script>
			$(document).ready(function() {
				
				$('.datepicker').datepicker({
					"autoclose": true
				});

			});
		</script>
		