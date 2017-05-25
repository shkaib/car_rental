<?php
	ob_start();
	session_cache_expire(30);
	session_start();
	error_reporting(E_ALL & ~E_NOTICE);
	$dbCfg = array();
	include_once(dirname(__FILE__) . '/global_config.php');
	// database configuration
	if($_SERVER['HTTP_HOST'] == "localhost"){
		$dbCfg['host']			= "localhost:3306";
		$dbCfg['db_user']		= "ftpbwadm_express";
		$dbCfg['db_passwd']		= "1b#v8QUZ2DE=";
		$dbCfg['db_name']		= "ftpbwadm_expresscar";
	}
	else{
		$dbCfg['host']			= "localhost:3306";
		$dbCfg['db_user']		= "expressr_ex";
		$dbCfg['db_passwd']		= "uB,^l8+u%,tl";
		$dbCfg['db_name']		= "expressr_express";
	}
	
	/************************/
	
	//define('ROOT_HOST','http://www.bwadco.com/rentacar/');
	//define('HTML_PATH','html/');
	//define('INC_PATH','includes/');
	//define('SITE_PATH','/home/bwadco/public_html/rentacar/');

	$agent = $_SERVER['HTTP_USER_AGENT'];
	if(preg_match('/Linux/',$agent)) $GetCssFile = 'CssMain_25-06-14.css';
	elseif(preg_match('/Win/',$agent)) $GetCssFile = 'CssMain_25-06-14.css';
	elseif(preg_match('/Mac/',$agent)) $GetCssFile = 'CssMain_25-06-14.css';
	else $GetCssFile = 'CssMain_25-06-14.css';
	//echo $GetCssFile;
	
	
	/**
	 * import()
	 *
	 * @param mixed $className
	 * @return
	 */
	function import($className){
		if($className && $className != ""){
			$className = "classes/class." . $className . ".php";
			if(file_exists(SITE_PATH . $className)){
				require_once(SITE_PATH . $className);
			}
		}
	}
	
	/**
	 * getImage()
	 *
	 * @param string $imagename
	 * @param string $ext
	 * @return
	 */
	function getimage($imagename, $ext){
		return $imagename . '_' . strtolower(SITE_LANG) . '.' . $ext;
	}
	
	/**
	 * importJs()
	 *
	 * @param mixed $jsFile
	 * @return
	 */
	function importJs($jsFile){
		if($jsFile && $jsFile != ""){
			$jsFile = "jscript/Js" . $jsFile . ".js";
			if(file_exists(SITE_PATH . $jsFile)){
				echo "<script language=\"javascript\" type=\"text/javascript\" src=\"" . SITE_URL . $jsFile . "\"></script>\n";
			}
		}
	}
	
	/**
	 * printArray()
	 *
	 * @param array $arr
	 * @return
	 */
	function printPre($str, $exit = false){
		echo '<pre style="text-align:left;">' . $str . '</pre>';
		if($exit){
			exit();
		}
	}
	
	/**
	 * printArray()
	 *
	 * @param array $arr
	 * @return
	 */
	function printArray($arr, $exit = false){
		echo '<pre style="text-align:left;">';
		print_r($arr);
		echo '</pre>';
		if($exit){
			exit();
		}
	}
	
	/**
	 * importCss()
	 *
	 * @param mixed $cssFile
	 * @return
	 */
	function importCss($cssFile){
		if($cssFile && $cssFile != ""){
			$cssFile = "css/Css" . $cssFile . ".css";
			if(file_exists(SITE_PATH . $cssFile)){
				echo "<link href=\"" . SITE_URL . $cssFile . "\" rel=\"stylesheet\" type=\"text/css\" />\n";
			}
		}
	}
	
	/**
	 * buildUrl()
	 *
	 * @param string $url
	 * @param integer $refSecond
	 * @return
	 */
	function buildUrl($url = ""){
		header("Location:" . $url);
		die();
	}
	
	/**
	 * redirect()
	 *
	 * @param string $url
	 * @param integer $refSecond
	 * @return
	 */
	function redirect($url = "", $refSecond = 0){
		header("Location:" . $url);
		die();
	}
	
	/**
	 * doDefine()
	 *
	 * @param mixed $configs
	 * @return
	 */
	function doDefine($configs){
		$str = "";
		if($configs){
			foreach($configs as $key=>$value){
				$str .= "define(\"" . strtoupper($key) . "\",\"" . $value . "\");\n";
			}
		}
		return $str;
	}
	
	/*********** Define the values *********/
	$defines = doDefine($_CONFIG);
	echo eval($defines);
	
	/**
	 * __autoload()
	 *
	 * @param string $class_name
	 * @return
	 */
	function __autoload($class_name){
		// class directories
		$dirs = array(
			'classes/',
			'classes/core/',
			'classes/utfexport/'
		);
		
		// for each directory
		foreach($dirs as $dir){
			// see if the file exsists
			if(file_exists(SITE_PATH . $dir . $class_name . '.php')){
				require_once(SITE_PATH . $dir . $class_name . '.php');
				// only require the class once, so quit after to save effort (if you got more, then name them something else
			return;
			}
		}
	}
	
	/**
	 * getPage()
	 *
	 * @param string $log_module
	 * @return
	 */
	function getPage($page){
		if(isset($page) && !empty($page)){
			$filename = HTML_PATH . ($page) . '.default' . '.php';
			if(file_exists($filename))
				return HTML_PATH . ($page) . '.default' . '.php';
			else
				return HTML_PATH . '404' . '.php';
		}
		else{
			return HTML_PATH . 'default.php';
		}
	}
	
	function getDomain(){
		$host = $_SERVER["HTTP_HOST"];
		$host = str_replace('www.', '', $host);
		return '.' . $host;
	}
	
	function getPageName(){
		$PageName = $_GET['category_cd'];
		return $PageName;
	}
	
	function GetEncptBKL(){
		$Back_Link = $_SERVER['HTTP_REFERER'];
		$En_BKLINK = base64_encode($Back_Link);
		return $En_BKLINK;
	}
	
	function GetDecptBKL($BLK){
		$De_BKLINK = base64_decode($BLK);
		return $De_BKLINK;
	}
	
	function dateFormate($GetDate){
	list($Year,$Month,$Day)= explode('-', $GetDate);
	$FinalDate = $Day .'/'. $Month;
		return $FinalDate;	
	}
	
	function dateFormate_2($GetDate){
	list($Year,$Month,$Day)= explode('-', $GetDate);
	$FinalDate = $Day .' / '. $Month .' <br> '. $Year;
		return $FinalDate;	
	}
	
	function dateFormate_3($GetDate){
	list($Year,$Month,$Day)= explode('-', $GetDate);
	$FinalDate = $Day .'/'. $Month .'/'. $Year;
		return $FinalDate;	
	}
	
	function dateFormate_4($GetDate){
	list($GTDate,$GTTime)= explode(' ', $GetDate);
	list($Year,$Month,$Day)= explode('-', $GTDate);
	$FinalDate = $Day .'/'. $Month .'/'. $Year;
		return $FinalDate;	
	}
	
	function dateFormate_7($GetDate){
	list($GTDate,$GTTime)= explode(' ', $GetDate);
	list($Year,$Month,$Day)= explode('-', $GTDate);
	$FinalDate = $Day .'/'. $Month .'/'. substr($Year,2,4);
		return $FinalDate;	
	}
	
	function dateFormate_6($GetDate){
	list($Year,$Month,$Day)= explode('-', $GetDate);
	$FinalDate = date("M") .'-'. $Day;
		return $FinalDate;	
	}
	
	function DTFormate($GetDateTime){
	list($RegDate,$RegTime)= explode(' ', $GetDateTime);
	list($Year,$Month,$Day)= explode('-', $RegDate);
	$FinalDateTime = $Day .'-'. $Month .'-'. $Year . ' ' . $RegTime;
		return $FinalDateTime;	
	}
	
	function GetMonth($Month){
		if($Month=='Jan'){
			$MonthM = 01;
			} elseif($Month=='Feb'){
				$MonthM = 02;
				} elseif($Month=='Mar'){
					$MonthM = 03;
					} elseif($Month=='Apr'){
						$MonthM = 04;
						} elseif($Month=='May'){
							$MonthM = 05;
							} elseif($Month=='Jun'){
								$MonthM = 06;
								} elseif($Month=='Jul'){
									$MonthM = 07;
									} elseif($Month=='Aug'){
										$MonthM = 08;
										} elseif($Month=='Sep'){
											$MonthM = 09;
											 } elseif($Month=='Oct'){
												  $MonthM = 10;
												   } elseif($Month=='Nov'){
													   $MonthM = 11;
													    } elseif($Month=='Dec'){
															$MonthM = 12;
															}
		return $MonthM;
	}
	
	
	function dateFormate_8($GetDate){
	list($Year,$Month,$Day)= explode('-', $GetDate);
		if($Month==1){
			$MonthM = 'Jan';
			} elseif($Month==2){
				$MonthM = 'Feb';
				} elseif($Month==3){
					$MonthM = 'Mar';
					} elseif($Month==4){
						$MonthM = 'Apr';
						} elseif($Month==5){
							$MonthM = 'May';
							} elseif($Month==6){
								$MonthM = 'Jun';
								} elseif($Month==7){
									$MonthM = 'Jul';
									} elseif($Month==8){
										$MonthM = 'Aug';
										} elseif($Month==9){
											$MonthM = 'Sep';
											 } elseif($Month==10){
												  $MonthM = 'Oct';
												   } elseif($Month==11){
													   $MonthM = 'Nov';
													    } elseif($Month==12){
															$MonthM = 'Dec';
															}
	$FinalDate = $MonthM .' '. $Day.', '. $Year;
		return $FinalDate;	
	}
	
	function dateFormate_9($GetDate){
	list($RegDate,$RegTime)= explode(' ', $GetDate);
	list($Year,$Month,$Day)= explode('-', $RegDate);
		if($Month==1){
			$MonthM = 'Jan';
			} elseif($Month==2){
				$MonthM = 'Feb';
				} elseif($Month==3){
					$MonthM = 'Mar';
					} elseif($Month==4){
						$MonthM = 'Apr';
						} elseif($Month==5){
							$MonthM = 'May';
							} elseif($Month==6){
								$MonthM = 'Jun';
								} elseif($Month==7){
									$MonthM = 'Jul';
									} elseif($Month==8){
										$MonthM = 'Aug';
										} elseif($Month==9){
											$MonthM = 'Sep';
											 } elseif($Month==10){
												  $MonthM = 'Oct';
												   } elseif($Month==11){
													   $MonthM = 'Nov';
													    } elseif($Month==12){
															$MonthM = 'Dec';
															}
	$FinalDate = $Day .' '. $MonthM .' '. $Year;
		return $FinalDate;	
	}
	
	function dateFormate_10($Month){
		if($Month==1){
			$MonthM = 'Jan';
			} elseif($Month==2){
				$MonthM = 'Feb';
				} elseif($Month==3){
					$MonthM = 'Mar';
					} elseif($Month==4){
						$MonthM = 'Apr';
						} elseif($Month==5){
							$MonthM = 'May';
							} elseif($Month==6){
								$MonthM = 'Jun';
								} elseif($Month==7){
									$MonthM = 'Jul';
									} elseif($Month==8){
										$MonthM = 'Aug';
										} elseif($Month==9){
											$MonthM = 'Sep';
											 } elseif($Month==10){
												  $MonthM = 'Oct';
												   } elseif($Month==11){
													   $MonthM = 'Nov';
													    } elseif($Month==12){
															$MonthM = 'Dec';
															}
	$FinalDate = $MonthM .' '. $Day.', '. $Year;
		return $FinalDate;	
	}
	
	function GetDayName($DayID){
		if($DayID==1){
			$DayName = 'Monday';
			} elseif($DayID==2){
				$DayName = 'Tuesday';
				} elseif($DayID==3){
					$DayName = 'Wednesday';
					} elseif($DayID==4){
						$DayName = 'Thursday';
						} elseif($DayID==5){
							$DayName = 'Friday';
							} elseif($DayID==6){
								$DayName = 'Saturday';
								} elseif($DayID==7){
									$DayName = 'Sunday';
									}
		return $DayName;
	}
	
	function TotalHours($hour_id){
		if($hour_id==1){
			$PrintHour = '0-10';
		} elseif($hour_id==2){
			$PrintHour = '10-20';
		} elseif($hour_id==3){
			$PrintHour = '20-30';
		} elseif($hour_id==4){
			$PrintHour = '30+';
		}
		return $PrintHour;
	}
	
	function Age($Age_id){
		if($Age_id==1){
			$Age_r = 'Under 16';
			} elseif($Age_id==2){
				$Age_r = '16 - 19';
				} elseif($Age_id==3){
					$Age_r = '20 - 24';
					} elseif($Age_id==4){
						$Age_r = '25 - 30';
						} elseif($Age_id==5){
							$Age_r = '30 - 40';
							} elseif($Age_id==6){
								$Age_r = '40+';
								}
		return $Age_r;	
	}
	
	function SkillLevel($Skill){
		if($Skill==1){
			$SkillName = 'Introductory';	
		} elseif($Skill==2){
			$SkillName = 'Beginner';
		} elseif($Skill==3){
			$SkillName = 'Intermediate';
		} elseif($Skill==4){
			$SkillName = 'Expert';
		} elseif($Skill==5){
			$SkillName = 'Advanced';
		}
		return $SkillName;
	}
	
	function residential_status($RedStatus){
		if($RedStatus==1){
			$StatusDetail = 'Present';
		} elseif($RedStatus==2){
			$StatusDetail = 'Leave';
		}
		return $StatusDetail;
	}
	
	function Gender($GenderID){
		if($GenderID==1){
			$GenderName = 'Male';
		} elseif($GenderID==2){
			$GenderName = 'Female';
		}
		return $GenderName;
	}
	
	function JobBuyerStatus($Status){
		//1=>Active, 2=>InActive, 3=>Pending Approval, 4=>Complete
		if($Status==1){
			$StatusTitle = 'Active';
			} elseif($Status==2){
				$StatusTitle = 'InActive';
				} elseif($Status==3){
					$StatusTitle = 'Pending Approval';
					} elseif($Status==4){
						$StatusTitle = 'Complete';
						}
		return $StatusTitle;
	}
	
	function UploadFileType($GetFileType){
	list($Application,$FileType)= explode('/', $GetFileType);
		if($FileType=='jpeg'){
			$ReturnFileType = 'JPG';
			} elseif($FileType=='jpg'){
				$ReturnFileType = 'JPG';
				} elseif($FileType=='png'){
					$ReturnFileType = 'PNG';
					} elseif($FileType=='gif'){
						$ReturnFileType = 'GIF';
						} elseif($FileType=='vnd.ms-excel'){
							$ReturnFileType = 'MS.EXCEL';
							} elseif($FileType=='msword'){
								$ReturnFileType = 'MS.WORD';
								} elseif($FileType=='vnd.openxmlformats-officedocument.wordprocessingml.document'){
									$ReturnFileType = 'MS.WORD';
									} elseif($FileType=='pdf'){
										$ReturnFileType = 'PDF';
										} elseif($FileType=='plain'){
											$ReturnFileType = 'TXT';
										}
			return $ReturnFileType;
	}
	
	function filepermissiontitle($PermissionID){
		if($PermissionID==1){
			$FileTypeName = 'Visible';
		} elseif($PermissionID==2){
			$FileTypeName = 'Invisible';
		}
		return $FileTypeName;
	}
	
	function SupportTicketCode($STID){
		$Day = date('d');
		$Hr = date('h');
		$Mint = date('i');
		$Secnd = date('s');
		$Month = date('m');
		$TicketCode = $Day . $Hr + $Mint + $Secnd + $Month . $STID;
	return $TicketCode;
	}
	
	function GetGrandTotal($GetProPrice){
		$GrandTotal += $GetProPrice;
		return $GrandTotal;
	}
	function relativeTime($dt,$precision=2){
	$times=array(	365*24*60*60	=> "year",
					30*24*60*60		=> "month",
					7*24*60*60		=> "week",
					24*60*60		=> "day",
					60*60			=> "hour",
					60				=> "minute",
					1				=> "second");
	
	$passed=time()-$dt;
	
	if($passed<5)
	{
		$output='less than 5 seconds ago';
	}
	else
	{
		$output=array();
		$exit=0;
		
		foreach($times as $period=>$name)
		{
			if($exit>=$precision || ($exit>0 && $period<60)) break;
			
			$result = floor($passed/$period);
			if($result>0)
			{
				$output[]=$result.' '.$name.($result==1?'':'s');
				$passed-=$result*$period;
				$exit++;
			}
			else if($exit>0) $exit++;
		}
				
		$output=implode(' and ',$output).' ago';
	}
	
	return $output;
	}

	function PickBoxResult($PBID){
		if($PBID==1){
			$ResultBack = 'Win';
			} elseif($PBID==2){
				$ResultBack = 'Loss';
				}
	return $ResultBack;	
	}
	
	function GetOrderBy($Query, $Order,$Cap, $type){
		$GetOrder = base64_decode($Order);
		if($Order==''){
		$ReturnBackQuery = '<a href="'.$Query.'&OY='.base64_encode('ASC').'&tp='.base64_encode($type).'">'.$Cap.'</a>';
		} elseif($GetOrder=='ASC'){
			$ReturnBackQuery = '<a href="'.$Query.'&OY='.base64_encode('DESC').'&tp='.base64_encode($type).'">'.$Cap.'</a>';
			} elseif($GetOrder=='DESC'){
				$ReturnBackQuery = '<a href="'.$Query.'&OY='.base64_encode('ASC').'&tp='.base64_encode($type).'">'.$Cap.'</a>';
			}
		return $ReturnBackQuery;
	}
	
	function CronName($CronID){
		if($CronID==1) {
			$CronName = 'Twitter Streaming Fetch Cron';
		} elseif($CronID==2) {
				$CronName = '';
			} elseif($CronID==3) {
					$CronName = '';
			}
		return $CronName;	
	}
	
	function CronStatus($CronSTID){
		if($CronSTID==1) {
			$CronSTName = 'Unable Streaming';
		} elseif($CronSTID==2) {
				$CronSTName = 'Temporary Stop';
			} elseif($CronSTID==3) {
					$CronSTName = 'Working (Active)';
				} elseif($CronSTID==4) {
						$CronSTName = 'No User Streaming List';
					}
		return $CronSTName;	
	}
	
	function EncData($Data){
		/*$stp_1 = base64_encode($Data);
			$stp_2 = base64_encode($stp_1);
				$stp_3 = base64_encode($stp_2);
					$stp_4 = base64_encode($stp_3);
						$stp_5 = base64_encode($stp_4);*/
		return $Data;
	}
	
	function DecData($Data){
		/*$stp_1 = base64_decode($Data);
			$stp_2 = base64_decode($stp_1);
				$stp_3 = base64_decode($stp_2);
					$stp_4 = base64_decode($stp_3);
						$stp_5 = base64_decode($stp_4);*/
		return $Data;
	}
	
	function MulValue($Value,$type){
		if($type==1){
		$EncValue = $Value * 12321;
		} elseif($type==2){
		$EncValue = $Value / 12321;
		}
		return $EncValue;
	}
	
	function GetTypeName($TypeID){

		if($TypeID==1){
			$TypeName = 'Player';
		} elseif($TypeID==2){
				$TypeName = 'Team';
			} elseif($TypeID==3){
					$TypeName = 'League';
				} elseif($TypeID==4){
						$TypeName = 'User';
						} elseif($TypeID==5){
							$TypeName = 'Sub Division';
							} elseif($TypeID==6){
								$TypeName = 'Conference';
								} elseif($TypeID==7){
									$TypeName = 'Weight class';
									} elseif($TypeID==8){
										$TypeName = 'Fighters';
					} else {
						$TypeName = 'User';
						}
		return $TypeName;
	}
	
	function GetBackPageName($bk){
		
		if($bk=='lm'){
			$BPageName = 'league_mgmt';
		} elseif($bk=='sdm'){
				$BPageName = 'sub_division_mgmt';
			} elseif($bk=='fm'){
					$BPageName = 'fighters_mgmt';
				} elseif($bk=='wcm'){
						$BPageName = 'weight_class_mgmt';
					} elseif($bk=='cm'){
							$BPageName = 'conference_mgmt';
						} elseif($bk=='tm'){
								$BPageName = 'team_mgmt';
						}
						
		return $BPageName;
	}
	
	function GetReturnMessage($bk){
		
		if($bk=='lm'){
			$BPageName = LEAGUES_HASHTAGS_MSG_SUCCESS;
		} elseif($bk=='sdm'){
				$BPageName = SUB_DIVISION_HASHTAGS_MSG_SUCCESS;
			} elseif($bk=='fm'){
					$BPageName = FIGHTERS_HASHTAGS_MSG_SUCCESS;
				} elseif($bk=='wcm'){
						$BPageName = WEIGHT_CLASS_HASHTAGS_MSG_SUCCESS;
					} elseif($bk=='cm'){
							$BPageName = CONFERENCE_HASHTAGS_MSG_SUCCESS;
						} elseif($bk=='tm'){
								$BPageName = TEAM_HASHTAGS_MSG_SUCCESS;
						}
						
		return $BPageName;
	}
	
	function StatusName($StatusID){
		if($StatusID==0){
			$BackStatus = 'InActive';
			} elseif($StatusID==1){
				$BackStatus = 'Active';
				} elseif($StatusID==2){
					$BackStatus = 'InActive';
					}
		return $BackStatus;
	}
	
	function HourPlus($HP){
		$GetHourBack = date("h:i:s", strtotime("-".$HP." hour"));
		return $GetHourBack;
	}
	
	function StreamTypeName($Type){	
		if($Type==1){
			$BackType = 'Twitter';
			} elseif($Type==2){
				//$BackType = 'Facebook';
				}
		return $BackType;
	}
	
	function StreamTypeList($Type){	
		$BackList = '';
		if($Type==1){
			$BackList .= "<option value=\"1\" selected># Twitter</option>\n";
			//$BackList .= "<option value=\"2\">facebook</option>\n";
			} elseif($Type==2){
				$BackList .= "<option value=\"1\"># Twitter</option>\n";
				//$BackList .= "<option value=\"2\" selected>facebook</option>\n";
				} else {
					$BackList .= "<option value=\"1\"># Twitter</option>\n";
					//$BackList .= "<option value=\"2\">facebook</option>\n";
					}
		return $BackList;
	}
	
	function SecQuestion($QusID){
		if($QusID==1){
		$secquestion = 'Question #1';
		} elseif($QusID==2){
		$secquestion = 'Question #2';
		} elseif($QusID==3){
		$secquestion = 'Question #3';
		}
		return $secquestion;
	}
	
	function conditiontype($condition_id){
		if($condition_id==1){
			$ConditionDetail = 'New';
		} else {
			$ConditionDetail = 'Used';
		}
		return $ConditionDetail;
	}
	
	function producttype($product_type_id){
		if($product_type_id==1){
			$ProTypeDetail = 'Sale';
		} elseif($product_type_id==2){
			$ProTypeDetail = 'Bid';
		} elseif($product_type_id==3){
			$ProTypeDetail = 'Swap';
		} elseif($product_type_id==4){
			$ProTypeDetail = 'Sale + Swap';
		}
		return $ProTypeDetail;
	}
	
	function checkvalue($GetValue, $Type){
		//1=> Email
		//2=> Text
		//3=> WebSite URl
		
			if($GetValue==''){
				$ReturnValue = 'Null';
			} else {
				if($Type==1){
					$ReturnValue = '<a href="mailto:'.$GetValue.'">'.$GetValue.'</a>';
				} elseif($Type==2){
						$ReturnValue = $GetValue;
					} elseif($Type==3){
							$ReturnValue = '<a href="http://'.$GetValue.'" target="_new">'.$GetValue.'</a>';
						}
			}
		return $ReturnValue;
	}
	
	function idealGoal($value_id){
		if($value_id==1){
			$returnValue = 'Website Development';
		} elseif($value_id==2){
				$returnValue = 'Application Development';
			} elseif($value_id==3){
					$returnValue = 'Both';
				} elseif($value_id==0){
						$returnValue = 'Non-Selection';
				}
		return $returnValue;
	}
	
	function PorposeOfSite($value_id){
		if($value_id==1){
				$returnvalue = 'Explain your products and services';
			} elseif($value_id==2){
					$returnvalue = 'Bring in new clients to your business';
				} elseif($value_id==3){
						$returnvalue = 'Provide your customers with information on a certain subject';
					} elseif($value_id==4){
							$returnvalue = 'Deliver news or calendar of events';
						} elseif($value_id==5){
								$returnvalue = 'Create a blog that addresses specific topics or interests';
							} elseif($value_id==6){
									$returnvalue = 'Sell a product or products online';
								} elseif($value_id==7){
										$returnvalue = 'Provide support for current clients';
									} elseif($value_id==0){
											$returnvalue = 'Non-Selection';
									}
		return $returnvalue;
	}
	
	function visiting_site($value_id){
		if($value_id==1){
				$ReturnValue = 'Call you';
			}elseif($value_id==2){
					$ReturnValue = 'Fill out a contact form';
				}elseif($value_id==3){
						$ReturnValue = 'Fill out a quote form';
					}elseif($value_id==4){
							$ReturnValue = 'Sign up for your mailing list';
						}elseif($value_id==5){
								$ReturnValue = 'Search for information';
							}elseif($value_id==6){
									$ReturnValue = 'Purchase a product(s)';
								}elseif($value_id==0){
										$ReturnValue = 'Non-Selection';
								}
		return $ReturnValue;
	}
	
	function residentialstatus($RS_ID){
		if($RS_ID==''){
			$ReturnValue = 'Present';
		} else {
			$ReturnValue = 'Leave';
		}
		return $ReturnValue;
	}
	
	function LeaseType($type_id){
		if($type_id==''){
			$ReturnValue = 'Personal';
		} else {
			$ReturnValue = 'Corporate';
		}
		return $ReturnValue;
	}
	
	function LimousineType($type_id){
		if($type_id==1){
			$ReturnValue = 'Ford.Taurus 2016';
		} elseif($type_id==1){
			$ReturnValue = 'Chevrolet. Impala 2016';
		} elseif($type_id==1){
			$ReturnValue = 'BMW 740 2015';
			} elseif($type_id==1){
				$ReturnValue = 'Mercedes E300 2015';
		}
		return $ReturnValue;
	}
	
	function RentType($type_id){
		if($type_id==1){
			$ReturnValue = 'Daily';
		} else {
			$ReturnValue = 'Monthly';
		}
		return $ReturnValue;
	}
	
	function GetTimeDiff($date1,$date2){
		if($date2=='0000-00-00'){
			$LastDate = date('Y-m-d');
		} else {
			$LastDate = $date2;
		}
		$diff = abs(strtotime($LastDate) - strtotime($date1));
		$years = floor($diff / (365*60*60*24));
		$months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
		$days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));
			if($years!=0){
			if($years==1){ $YearTitle = ' Year'; } else { $YearTitle = ' Years'; }
			if($months!=0){
			if($months==1){ $MonthTitle = ' Month'; } else { $MonthTitle = ' Months'; }	
			$ReturnDiff = $years.$YearTitle.', '.$months.$MonthTitle;
			} else {
			$ReturnDiff = $years.$YearTitle;	
			}
			} else {
			if($months!=0){
			if($months==1){ $MonthTitle = ' Month'; } else { $MonthTitle = ' Months'; }	
			$ReturnDiff = $months.$MonthTitle;
			} else {
			if($days==1){ $DayTitle = ' Day'; } else { $DayTitle = ' Days'; }
			$ReturnDiff = $days.$DayTitle;
			}
			}
	return $ReturnDiff;
	}
	
	// see if language is changed.

	if($_SESSION['allsite_lang']==''){
		$_SESSION['allsite_lang'] = $_CONFIG['lang'];
		$_CONFIG['lang'] = 'NL';
		setcookie('allsite_lang', $_CONFIG['lang'], time() + 31536000); // store the language in cookie for 1 year (365 days)
	} elseif($_REQUEST['C']=='LNG'){
		$_CONFIG['lang'] = $_REQUEST['lang'];
		$_SESSION['allsite_lang'] = $_REQUEST['lang'];
		setcookie('allsite_lang', $_CONFIG['lang'], time() + 31536000); // store the language in cookie for 1 year (365 days)
		$link = $_SERVER["HTTP_REFERER"];
		redirect($link);
	}
	
	define('SITE_LANG', $_SESSION['allsite_lang']);
	//define("PERPAGE", 50);
	
	/*********** Define the values *********/
	define("HOST", $dbCfg['host']);
	define("DBUSER", $dbCfg['db_user']);
	define("DBPASSWD", $dbCfg['db_passwd']);
	define("DBNAME", $dbCfg['db_name']);
	
	define("SITE_URL", ROOT_HOST);


?>