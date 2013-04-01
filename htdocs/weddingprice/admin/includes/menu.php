<?
$filename = basename($_SERVER['SCRIPT_FILENAME']);
?>
<div id="menu_wrapper">
	<ul class="nav">
    	<!--Start LI Tag For Menu-->
        <li>
        	<a href="home.php" <? if($filename=="home.php") echo "class='active'";?>>
            	Home
            </a>
		</li>
        <? if(false){ ?>
        <li>
			<a href="" <? if($filename=="main-users.php" or $filename =="edit-users.php") echo "class='active'";?>>
            	Administrators
            </a>
            <div class="popup">
            	<div class="top"></div>
                <div class="content">
                   	<ul class="submenu">
                       	<li>
                           	<a href="main-users.php">
                               	Manage Users
                            </a>
                         </li>
                     </ul>
                     <br class="clear"/>
                </div>
               	<div class="footer"></div>
            </div>
        </li>
        <? } ?>
        <li>
			<a href="" <? if($filename=="main-supplier-listing.php" or $filename =="add-edit-supplier.php" or $filename=="main-buyer-listing.php" or $filename =="add-edit-buyer.php") echo "class='active'";?> >
            	Users
            </a>
            <div class="popup">
            	<div class="top"></div>
                <div class="content">
                   	<ul class="submenu">                      
						<li>
                           	<a href="main-supplier-listing.php">
                               	Manage Suppliers
                            </a>
                        </li>   
						<li>
                           	<a href="main-buyer-listing.php">
                               	Manage Buyers
                            </a>
                        </li>   
                     </ul>
                     <br class="clear"/>
                </div>
               	<div class="footer"></div>
            </div>
        </li>
        
        <li>
			<a href="" <? if($filename=="main-wedding-listing.php" or $filename =="add-edit-wedding.php" or $filename =="main-bid-listing.php" or $filename =="add-edit-bid.php" or $filename =="main-weddingcategory-listing.php" or $filename =="add-edit-weddingcategory.php") echo "class='active'";?>>
            	Weddings
            </a>
            <div class="popup">
            	<div class="top"></div>
                <div class="content">
                   	<ul class="submenu">
                       	<li>
                           	<a href="main-wedding-listing.php">
                               	Manage Weddings
                            </a>
                        </li>
                        <li>
                        	&nbsp;
                        </li>
                        <li>
                        	<a href="main-bid-listing.php">
                               Manage Bids
                            </a>
                        </li>  
                        <li>
                        	&nbsp;
                        </li>
                        <li>
                        	<a href="main-weddingcategory-listing.php">
                               Manage Requests
                            </a>
                        </li>                       
                     </ul>
                     <br class="clear"/>
                </div>
               	<div class="footer"></div>
            </div>
        </li>			
		<li>
			<a href="main-category-listing.php" <? if($filename=="main-category-listing.php" or $filename =="add-edit-category.php" ) echo "class='active'";?>>
            	Categories
            </a>
        </li>		
		<li>
			<a href="main-region-listing.php" <? if($filename=="main-region-listing.php" or $filename =="add-edit-region.php" or $filename =="main-region-listing.php" or $filename =="add-edit-region.php") echo "class='active'";?>>
            	Regions
            </a>
        </li>
		<li>
			<a href="" <? //if($filename=="main-wedding-listing.php" or $filename =="add-edit-wedding.php" or $filename =="main-wedding-listing.php" or $filename =="add-edit-wedding.php") echo "class='active'";?>>
            	Discussions
            </a>
			<div class="popup">
            	<div class="top"></div>
                <div class="content">
                   	<ul class="submenu">
                       	<li>
                           	<a href="main-review-listing.php">
                               	Reviews
                            </a>
                        </li>
                        <li>
                        	&nbsp;
                        </li>
                        <li>
                        	<a href="main-message-listing.php">
                               Messages
                            </a>
                        </li>                        
                     </ul>
                     <br class="clear"/>
                </div>
               	<div class="footer"></div>
            </div>
        </li>
		<li>
			<a href="main-specialoffer-listing.php" <? if($filename=="main-specialoffer-listing.php" or $filename =="add-edit-specialoffer.php") echo "class='active'";?>>
            	Special Offers
            </a>
        </li>
		<li>
			<a href="" <? if($filename=="main-configuration-listing.php" or $filename =="add-edit-configuration.php" or $filename =="main-emailtemplate-listing.php" or $filename =="add-edit-emailtemplate.php") echo "class='active'";?>>
            	Configuration
            </a>
			<div class="popup">
            	<div class="top"></div>
                <div class="content">
                   	<ul class="submenu">
                       	<li>
                           	<a href="main-configuration-listing.php">
                               	Settings
                            </a>
                        </li>
                        <li>
                        	&nbsp;
                        </li>
                        <li>
                        	<a href="main-emailtemplate-listing.php">
                               Email Templates
                            </a>
                        </li>                        
                     </ul>
                     <br class="clear"/>
                </div>
               	<div class="footer"></div>
            </div>
        </li>
		<li>
			<a href="" <? if($filename=="main-faq-listing.php" or $filename =="add-edit-faq.php" or $filename =="main-faqcategory-listing.php" or $filename =="add-edit-faqcategory.php") echo "class='active'";?>>
            	FAQs
            </a>
			<div class="popup">
            	<div class="top"></div>
                <div class="content">
                   	<ul class="submenu">                      
						<li>
                           	<a href="main-faq-listing.php">
                               	Questions
                            </a>
                        </li>   
						<li>
                           	<a href="main-faqcategory-listing.php">
                               	Categories
                            </a>
                        </li>   
                     </ul>
                     <br class="clear"/>
                </div>
               	<div class="footer"></div>
            </div>
        </li>
		<li>
			<a href="main-goldpayment-listing.php" <? if($filename=="main-goldpayment-listing.php" or $filename =="add-edit-goldpayment.php" or $filename =="main-goldpayment-listing.php" or $filename =="add-edit-goldpayment.php") echo "class='active'";?>>
            	Gold Account Payments
            </a>
        </li>
		
    	<!--End LI Tag-->
    </ul>
</div>