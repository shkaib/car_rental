<div class="page-title-container">
            <div class="container">
                <div class="page-title pull-left">
                    <h2 class="entry-title">Payment Failed</h2>
                </div>
                 
            </div>
        </div>
        <section id="content">
            <div class="container">
                <div id="main">
                    <div class="image-style1 style1 large-block">
                       <h1 class="title">Sorry</h1>
                       <p>your payment has been failed</p>
                       <?php if($_GET['responsecode'] == '05'){?> 
                             <p>There is an issue with the card's bank, you should contact the bank to resolve the issue.</p>
                       <?php } ?>
                       <?php if($_GET['responsecode'] == '33'){?> 
                             <p>The customer card is expired.</p>
                       <?php } ?>  
                       <?php if($_GET['responsecode'] == '51'){?> 
                             <p>Insufficient funds.</p>
                       <?php } ?> 
                       <?php if($_GET['responsecode'] == '54'){?> 
                             <p>The customer card is expired.</p>
                       <?php } ?> 
                       <?php if($_GET['responsecode'] == '55'){?> 
                             <p>Incorrect pin number.</p>
                       <?php } ?>
                       <?php if($_GET['responsecode'] == '61'){?> 
                             <p>The card exceeds withdrawal amount limit.</p>
                       <?php } ?>  
                        <?php if($_GET['responsecode'] == '91'){?> 
                             <p>The bank is disconnected at the moment.</p>
                       <?php } ?>
                       <?php if($_GET['responsecode'] == '92'){?> 
                             <p>The card number is not yet mapped to the related bank.</p>
                       <?php } ?>      
                    </div>

                    
                </div> <!-- end main -->
            </div>
        </section>