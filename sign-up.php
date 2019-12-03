<?php
include('master.php');

$pageTitle = 'Sign-up for Black Rabbit Joomla Component Creator | Free | Joomla 2.5 & Joomla 3.0';
$pageActive = 'signup';
$pageActiveBreadcrumb = '<li class="active">Sign-up</li>';

include('template/header.php');

$msg = '';
if (isset($_REQUEST['msg'])) {
	switch($_REQUEST['msg']) {
		case "1":
			$msg = 'Please make sure you fill in all required fields!';
			break;
		case "2":
			$msg = 'This e-mail address has already been used. Please check for your validation e-mail and click the link provided.';
			break;
		default:
			$msg = 'watttt';
			break;
	}
}
?>
<div id="section-container">
	<div class="container">
		<div class="row">
			<div class="span12">
				<?php
				Msg::alert($msg, 'error');
				?>
				<h1>Sign-up for Membership</h1>
				<p class="lead">and be able to manage/edit/download all your components created!</p>
				<div id="scroller-anchor"></div>
				<div id="scroller" style="margin-top: 10px;" class="progress progress-striped active ">
					<div class="bar" style="width: 0%;"></div>
				</div><!-- /.progress -->
				<form id="signupform" action="register.php" method="post" class="form-horizontal">
					<ul class="nav nav-tabs" id="myTab">
						<li class="active"><a href="#price">Price / Features</a></li>
						<li><a href="#account">Account <span><span class="badge badge-important">6</span></span></a></li>
						<li><a href="#signup">Confirm Sign-up <span><span class="badge badge-important">1</span></span></a></li>
					</ul><!-- /#myTab -->
					<div class="tab-content">
						<div class="tab-pane active" id="price">
							<h3>Price / Features</h3>
							<p>Would you like to be able to save and go back and edit your past component created?</p>
							<p>Sign-up to be a life-time member for a <strong>one time fee</strong> and be able to do just that!</p>
							<p>Fill out the form tabs ahead and be on your way!</p>
							<p class="lead" style="margin: 0!important;">Price: $50.00</p>
						</div><!-- /#price -->
						<div class="tab-pane" id="account">
							<h3>Account</h3>
							<div class="control-group">
								<label class="control-label" for="fname">First Name</label>
								<div class="controls">
									<input type="text" name="fname" id="fname" placeholder="" class="required">
									<div class="status"></div>
								</div>
							</div>
							<div class="control-group">
								<label class="control-label" for="lname">Last Name</label>
								<div class="controls">
									<input type="text" name="lname" id="lname" placeholder="" class="required">
									<div class="status"></div>
								</div>
							</div>
							<div class="control-group">
								<label class="control-label" for="email">E-Mail</label>
								<div class="controls">
									<input type="text" name="email" id="email" placeholder="" class="required">
									<div class="status"></div>
									<span class="help-block">Validation E-mail will be sent, upon registration.</span>
								</div>
							</div>
							<div class="control-group">
								<label class="control-label" for="password">Password</label>
								<div class="controls">
									<input type="password" name="password" id="password" placeholder="" class="required">
									<div class="status"></div>
								</div>
							</div>
							<div class="control-group">
								<label class="control-label" for="password2">Confirm Password</label>
								<div class="controls">
									<input type="password" name="password2" id="password2" placeholder="" class="required">
									<div class="status"></div>
								</div>
							</div>
							<div class="control-group">
								<label class="control-label" for="country">Country</label>
								<div class="controls">
									<select name="country" id="country" class="required">
										<option value="">--Select Country--</option>
										<option value="US">United States</option>
										<option value="GB">United Kingdom</option>
										<option value="CA">Canada</option>
										<option value="">----------</option>
										<option value="AF">Afghanistan</option>
										<option value="AL">Albania</option>
										<option value="DZ">Algeria</option>
										<option value="AS">American Samoa</option>
										<option value="AD">Andorra</option>
										<option value="AO">Angola</option>
										<option value="AI">Anguilla</option>
										<option value="AQ">Antarctica</option>
										<option value="AG">Antigua and Barbuda</option>
										<option value="AR">Argentina</option>
										<option value="AM">Armenia</option>
										<option value="AW">Aruba</option>
										<option value="AU">Australia</option>
										<option value="AT">Austria</option>
										<option value="AZ">Azerbaidjan</option>
										<option value="BS">Bahamas</option>
										<option value="BH">Bahrain</option>
										<option value="BD">Bangladesh</option>
										<option value="BB">Barbados</option>
										<option value="BY">Belarus</option>
										<option value="BE">Belgium</option>
										<option value="BZ">Belize</option>
										<option value="BJ">Benin</option>
										<option value="BM">Bermuda</option>
										<option value="BT">Bhutan</option>
										<option value="BO">Bolivia</option>
										<option value="BA">Bosnia-Herzegovina</option>
										<option value="BW">Botswana</option>
										<option value="BV">Bouvet Island</option>
										<option value="BR">Brazil</option>
										<option value="IO">British Indian Ocean Territory</option>
										<option value="BN">Brunei Darussalam</option>
										<option value="BG">Bulgaria</option>
										<option value="BF">Burkina Faso</option>
										<option value="BI">Burundi</option>
										<option value="KH">Cambodia</option>
										<option value="CM">Cameroon</option>
										<option value="CV">Cape Verde</option>
										<option value="KY">Cayman Islands</option>
										<option value="CF">Central African Republic</option>
										<option value="TD">Chad</option>
										<option value="CL">Chile</option>
										<option value="CN">China</option>
										<option value="CX">Christmas Island</option>
										<option value="CC">Cocos (Keeling) Islands</option>
										<option value="CO">Colombia</option>
										<option value="KM">Comoros</option>
										<option value="CG">Congo</option>
										<option value="CK">Cook Islands</option>
										<option value="CR">Costa Rica</option>
										<option value="HR">Croatia</option>
										<option value="CU">Cuba</option>
										<option value="CY">Cyprus</option>
										<option value="CZ">Czech Republic</option>
										<option value="DK">Denmark</option>
										<option value="DJ">Djibouti</option>
										<option value="DM">Dominica</option>
										<option value="DO">Dominican Republic</option>
										<option value="TP">East Timor</option>
										<option value="EC">Ecuador</option>
										<option value="EG">Egypt</option>
										<option value="SV">El Salvador</option>
										<option value="GQ">Equatorial Guinea</option>
										<option value="ER">Eritrea</option>
										<option value="EE">Estonia</option>
										<option value="ET">Ethiopia</option>
										<option value="FK">Falkland Islands</option>
										<option value="FO">Faroe Islands</option>
										<option value="FJ">Fiji</option>
										<option value="FI">Finland</option>
										<option value="CS">Former Czechoslovakia</option>
										<option value="SU">Former USSR</option>
										<option value="FR">France</option>
										<option value="FX">France (European Territory)</option>
										<option value="GF">French Guyana</option>
										<option value="TF">French Southern Territories</option>
										<option value="GA">Gabon</option>
										<option value="GM">Gambia</option>
										<option value="GE">Georgia</option>
										<option value="DE">Germany</option>
										<option value="GH">Ghana</option>
										<option value="GI">Gibraltar</option>
										<option value="GB">Great Britain</option>
										<option value="GR">Greece</option>
										<option value="GL">Greenland</option>
										<option value="GD">Grenada</option>
										<option value="GP">Guadeloupe (French)</option>
										<option value="GU">Guam (USA)</option>
										<option value="GT">Guatemala</option>
										<option value="GN">Guinea</option>
										<option value="GW">Guinea Bissau</option>
										<option value="GY">Guyana</option>
										<option value="HT">Haiti</option>
										<option value="HM">Heard and McDonald Islands</option>
										<option value="HN">Honduras</option>
										<option value="HK">Hong Kong</option>
										<option value="HU">Hungary</option>
										<option value="IS">Iceland</option>
										<option value="IN">India</option>
										<option value="ID">Indonesia</option>
										<option value="INT">International</option>
										<option value="IR">Iran</option>
										<option value="IQ">Iraq</option>
										<option value="IE">Ireland</option>
										<option value="IL">Israel</option>
										<option value="IT">Italy</option>
										<option value="CI">Ivory Coast (Cote D&#39;Ivoire)</option>
										<option value="JM">Jamaica</option>
										<option value="JP">Japan</option>
										<option value="JO">Jordan</option>
										<option value="KZ">Kazakhstan</option>
										<option value="KE">Kenya</option>
										<option value="KI">Kiribati</option>
										<option value="KW">Kuwait</option>
										<option value="KG">Kyrgyzstan</option>
										<option value="LA">Laos</option>
										<option value="LV">Latvia</option>
										<option value="LB">Lebanon</option>
										<option value="LS">Lesotho</option>
										<option value="LR">Liberia</option>
										<option value="LY">Libya</option>
										<option value="LI">Liechtenstein</option>
										<option value="LT">Lithuania</option>
										<option value="LU">Luxembourg</option>
										<option value="MO">Macau</option>
										<option value="MK">Macedonia</option>
										<option value="MG">Madagascar</option>
										<option value="MW">Malawi</option>
										<option value="MY">Malaysia</option>
										<option value="MV">Maldives</option>
										<option value="ML">Mali</option><option value="MT">Malta</option>
										<option value="MH">Marshall Islands</option>
										<option value="MQ">Martinique (French)</option>
										<option value="MR">Mauritania</option>
										<option value="MU">Mauritius</option>
										<option value="YT">Mayotte</option>
										<option value="MX">Mexico</option>
										<option value="FM">Micronesia</option>
										<option value="MD">Moldavia</option>
										<option value="MC">Monaco</option>
										<option value="MN">Mongolia</option>
										<option value="MS">Montserrat</option>
										<option value="MA">Morocco</option>
										<option value="MZ">Mozambique</option>
										<option value="MM">Myanmar</option>
										<option value="NA">Namibia</option>
										<option value="NR">Nauru</option>
										<option value="NP">Nepal</option>
										<option value="NL">Netherlands</option>
										<option value="AN">Netherlands Antilles</option>
										<option value="NT">Neutral Zone</option>
										<option value="NC">New Caledonia (French)</option>
										<option value="NZ">New Zealand</option>
										<option value="NI">Nicaragua</option>
										<option value="NE">Niger</option>
										<option value="NG">Nigeria</option>
										<option value="NU">Niue</option>
										<option value="NF">Norfolk Island</option>
										<option value="KP">North Korea</option>
										<option value="MP">Northern Mariana Islands</option>
										<option value="NO">Norway</option>
										<option value="OM">Oman</option>
										<option value="PK">Pakistan</option>
										<option value="PW">Palau</option>
										<option value="PA">Panama</option>
										<option value="PG">Papua New Guinea</option>
										<option value="PY">Paraguay</option>
										<option value="PE">Peru</option>
										<option value="PH">Philippines</option>
										<option value="PN">Pitcairn Island</option>
										<option value="PL">Poland</option>
										<option value="PF">Polynesia (French)</option>
										<option value="PT">Portugal</option>
										<option value="PR">Puerto Rico</option>
										<option value="QA">Qatar</option>
										<option value="RE">Reunion (French)</option>
										<option value="RO">Romania</option>
										<option value="RU">Russian Federation</option>
										<option value="RW">Rwanda</option>
										<option value="GS">S. Georgia & S. Sandwich Isls.</option>
										<option value="SH">Saint Helena</option>
										<option value="KN">Saint Kitts & Nevis Anguilla</option>
										<option value="LC">Saint Lucia</option>
										<option value="PM">Saint Pierre and Miquelon</option>
										<option value="ST">Saint Tome (Sao Tome) and Principe</option>
										<option value="VC">Saint Vincent & Grenadines</option>
										<option value="WS">Samoa</option>
										<option value="SM">San Marino</option>
										<option value="SA">Saudi Arabia</option>
										<option value="SN">Senegal</option>
										<option value="SC">Seychelles</option>
										<option value="SL">Sierra Leone</option>
										<option value="SG">Singapore</option>
										<option value="SK">Slovak Republic</option>
										<option value="SI">Slovenia</option>
										<option value="SB">Solomon Islands</option>
										<option value="SO">Somalia</option>
										<option value="ZA">South Africa</option>
										<option value="KR">South Korea</option>
										<option value="ES">Spain</option>
										<option value="LK">Sri Lanka</option>
										<option value="SD">Sudan</option>
										<option value="SR">Suriname</option>
										<option value="SJ">Svalbard and Jan Mayen Islands</option>
										<option value="SZ">Swaziland</option>
										<option value="SE">Sweden</option>
										<option value="CH">Switzerland</option>
										<option value="SY">Syria</option>
										<option value="TJ">Tadjikistan</option>
										<option value="TW">Taiwan</option>
										<option value="TZ">Tanzania</option>
										<option value="TH">Thailand</option>
										<option value="TG">Togo</option>
										<option value="TK">Tokelau</option>
										<option value="TO">Tonga</option>
										<option value="TT">Trinidad and Tobago</option>
										<option value="TN">Tunisia</option>
										<option value="TR">Turkey</option>
										<option value="TM">Turkmenistan</option>
										<option value="TC">Turks and Caicos Islands</option>
										<option value="TV">Tuvalu</option>
										<option value="UG">Uganda</option>
										<option value="UA">Ukraine</option>
										<option value="AE">United Arab Emirates</option>
										<option value="UY">Uruguay</option>
										<option value="MIL">USA Military</option>
										<option value="UM">USA Minor Outlying Islands</option>
										<option value="UZ">Uzbekistan</option>
										<option value="VU">Vanuatu</option>
										<option value="VA">Vatican City State</option>
										<option value="VE">Venezuela</option>
										<option value="VN">Vietnam</option>
										<option value="VG">Virgin Islands (British)</option>
										<option value="VI">Virgin Islands (USA)</option>
										<option value="WF">Wallis and Futuna Islands</option>
										<option value="EH">Western Sahara</option>
										<option value="YE">Yemen</option>
										<option value="YU">Yugoslavia</option>
										<option value="ZR">Zaire</option>
										<option value="ZM">Zambia</option>
										<option value="ZW">Zimbabwe</option>
									</select>
									<div class="status"></div>
								</div>
							</div>
						</div><!-- /#account -->
						<div class="tab-pane" id="signup">
							<h3>Sign-up</h3>
							<p>You will receive an e-mail <strong>(if not received immediately, check your spam folder)</strong> to validate that you own the e-mail address provided, once that has been done, you will then be able to login using your e-mail and password.</p>
							<p>After logging in you will be able to pay the one time fee and get started creating/editing/managing your components you create from here on out, as long as you are logged in and have paid!</p>
							<p>By hitting submit, I agree to the <a href="terms.php" target="_blank">terms</a>.</p>
							<div class="control-group">
								<div class="controls">
									<label class="radio">
										<input type="radio" id="agree1" name="agree" value="0" checked> I do not agree.
									</label>
									<label class="radio">
										<input type="radio" id="agree2" name="agree" value="1" class="required"> Yes I agree.
									</label>
								</div>
							</div>
							<div class="form-actions">
								<input type="submit" name="submit" id="submit" value="Sign-up" class="btn btn-primary" />
							</div>
						</div><!-- /#signup -->
					</div><!-- /.tab-content -->
				</form><!-- /form -->
			</div><!-- /.span12 -->
		</div><!-- /.row -->

		<div class="row">
			<div class="span12">
				<div class="well">
					<?php
					if (Access::notLoggedInOrPaid()) {
					?>
						<span class="hidden-phone">
							<div class="page-ad pull-right">
								<img src="https://via.placeholder.com/250" />
								<br />
								Place Ad Here
							</div><!-- /.page-ad -->
						</span>
					<?php
					}
					?>
					<h2>Why Membership?</h2>
					<ul class="why-membership">
						<li><i class="icon icon-ok"></i> Save all components and modules created!</li>
						<li><i class="icon icon-remove"></i> No Ads</li>
						<li><i class="icon icon-thumbs-up"></i> It's a one time fee... that's it, seriously.</li>
						<li><i class="icon icon-pencil"></i> So <a href="sign-up.php">sign up</a></li>
						<li>
							<span class="btn" id="showVideo"><i class="icon-film"></i> Show Video</span>
							<div id="membershipVideo" class="hide">
								<iframe width="100%" height="400" src="http://www.youtube.com/embed/MtuBpjKm06c" frameborder="0" allowfullscreen></iframe>
							</div><!-- /#membershipVideo -->
						</li>
					</ul>
					<br /><br />
				</div><!-- /.well -->
			</div><!-- /.span12 -->
		</div><!-- /.row -->

	</div><!-- /.container -->
</div><!-- /#section-container -->
<?php
include('template/footer.php');
