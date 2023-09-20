 <?php 
    $examId = $_GET['id'];
    $selExam = $conn->query("SELECT * FROM exam_tbl WHERE ex_id='$examId' ")->fetch(PDO::FETCH_ASSOC);

 ?>

<div class="app-main__outer">
<div class="app-main__inner">
    <div id="refreshData">
            
    <div class="col-md-12">
        <div class="app-page-title">
            <div class="page-title-wrapper">
                <div class="page-title-heading">
                    <div>
                        <?php echo $selExam['ex_title']; ?>
                          <div class="page-title-subheading">
                            <?php echo $selExam['ex_description']; ?>
                          </div>

                    </div>
                </div>
            </div>
        </div>  
        <div class="row col-md-12">
        	<h1 class="text-primary">RESULT'S</h1>
        </div>

        <div class="row col-md-6 float-left">
        	<div class="main-card mb-3 card">
                <div class="card-body">
                	<h5 class="card-title">Your Answer's</h5>
        			<table class="align-middle mb-0 table table-borderless table-striped table-hover" id="tableList">
                    <?php 
                    	$selQuest = $conn->query("SELECT * FROM exam_question_tbl eqt INNER JOIN exam_answers ea ON eqt.eqt_id = ea.quest_id WHERE eqt.exam_id='$examId' AND ea.axmne_id='$exmneId' AND ea.exans_status='new' ");
                    	$i = 1;
                    	while ($selQuestRow = $selQuest->fetch(PDO::FETCH_ASSOC)) { ?>
                    		<tr>
                    			<td>
                    				<b><p><?php echo $i++; ?> .) <?php echo $selQuestRow['exam_question']; ?></p></b>
                    				<label class="pl-4 text-success">
                    					Answer : 
                    					<?php 
                    						if($selQuestRow['exam_answer'] != $selQuestRow['exans_answer'])
                    						{ ?>
                    							<span style="color:red"><?php echo $selQuestRow['exans_answer']; ?></span>
                    						<?PHP }
                    						else
                    						{ ?>
                    							<span class="text-success"><?php echo $selQuestRow['exans_answer']; ?></span>
                    						<?php }
                    					 ?>
                    				</label>
                    			</td>
                    		</tr>
                    	<?php }
                     ?>
	                 </table>
                </div>
            </div>
        </div>

        <div class="col-md-6 float-left">
        	<div class="col-md-6 float-left">
        	<div class="card mb-3 widget-content bg-night-fade">
                <div class="widget-content-wrapper text-white">
                    <div class="widget-content-left">
                        <div class="widget-heading"><h5>Score</h5></div>
                        <div class="widget-subheading" style="color: transparent;">/</div>
                    </div>
                    <div class="widget-content-right">
                        <div class="widget-numbers text-white">
                            <?php 
                                $selScore = $conn->query("SELECT * FROM exam_question_tbl eqt INNER JOIN exam_answers ea ON eqt.eqt_id = ea.quest_id AND eqt.exam_answer = ea.exans_answer  WHERE ea.axmne_id='$exmneId' AND ea.exam_id='$examId' AND ea.exans_status='new' ");
                            ?>
                            <span>
                                <?php echo $selScore->rowCount(); ?>
                                <?php 
                                    $over  = $selExam['ex_questlimit_display'];
                                 ?>
                            </span> / <?php echo $over; ?>
                        </div>
                    </div>
                </div>
            </div>
        	</div>

            <div class="col-md-6 float-left">
             <div class="card mb-3 widget-content bg-happy-green">
                <div class="widget-content-wrapper text-white">
                    <div class="widget-content-left">
                        <div class="widget-heading" style=""><h5>Percentage</h5><br></div>
                        <div class="widget-subheading" style="color: transparent;">/</div>
                        </div>
                        <div class="widget-content-right">
                        <div class="widget-numbers text-white">
                            <?php 
                                $selScore = $conn->query("SELECT * FROM exam_question_tbl eqt INNER JOIN exam_answers ea ON eqt.eqt_id = ea.quest_id AND eqt.exam_answer = ea.exans_answer  WHERE ea.axmne_id='$exmneId' AND ea.exam_id='$examId' AND ea.exans_status='new' ");
                            ?>
                            <span>
                                <!-- <?php 
                                    $score = $selScore->rowCount();
                                    $ans = $score / $over * 100;
                                    echo number_format($ans,2);
                                    echo "%";
                                    
                                 ?> -->

<?php 
                            $score = $selScore->rowCount();
                            $ans = $score / $over * 100;
                            echo number_format($ans, 2);
                            echo "%";

                            // Check if the percentage is 50 and print "BSIt" if true
                            if ($ans == 50.00) {
                                echo " BSIt";
                            }
                        ?>
                            </span> 
                        </div>
                    </div>
                </div>
            </div>
            <style>
                body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    display: flex;
    flex-direction: column;
    align-items: center;
    min-height: 100vh;
    background-color: #f4f4f4;
    position: relative; /* Add this line */
}

.header {
    display: flex;
    align-items: center;
    margin-bottom: 10px;
    padding: 5px;
    background-color: #f4f4f4;
    color: black;
    position: fixed;
    top: 350px;
    right: 0px;
    bottom: 20vh;
}

.logo {
    width: 80px;
    height: 80px;
    margin-right: 10px;
    align-items: center;
}

.title {
    font-size: 24px;
}

.chat-container {
    border: 1px solid #ccc;
    border-radius: 5px;
    width: auto;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
    background-color: #FFEADD;
    position: fixed; /* Add this line */
    bottom: 20px; /* Adjust the distance from the bottom as needed */
    right: 20px; /* Adjust the distance from the right as needed */
}

.chat-box {
    padding: 10px;
    max-height: 200px;
    overflow-y: auto;
}

.chat-message {
    margin: 5px;
    padding: 8px;
    border-radius: 8px;
    text-align: right;
    background-color: #FF9B9B;
    color: white;
}

.bot-message {
    background-color: #A8A196;
    text-align: left;
}

.user-input {
    display: flex;
    align-items: center;
    padding: 10px;
    border-top: 1px solid #ccc;
    color: #007bff;
}

#userInput {
    flex: 1;
    padding: 8px;
    border: none;
    border-radius: 5px;
    outline: none;
}

#sendMessage {
    padding: 10px 15px;
    border: none;
    border-radius: 5px;
    background-color: #007bff;
    color: white;
    cursor: pointer;
}

/* Media query for screens with a maximum width of 768px */
@media (max-width: 768px) {
    .chat-container {
        width: 100%; /* Adjust the width for smaller screens */
        right: 0; /* Reset right position for smaller screens */
    }
}

            </style>
            <body>
                            <header class="header">
                        <img src="ucs.png" alt="Chatbot Logo" class="logo">
                        <br>
                        <h1 class="title">Career Advice Consultation Chatbot</h1>
                    </header>

                    <div class="chat-container">
                        <div class="chat-box" id="chatBox">
                            <div class="chat-message bot-message">Hello! 
                                This is the Career Advice Consultation Chatbot</div>
                            <div class="chat-message bot-message">To make start please type: "Get Started"</div>
                        </div>
                        <div class="user-input">
                            <input type="text" id="userInput" placeholder="Type your message...">
                            <button id="sendMessage">Send </i></button>
                        </div>
                    </div>
                    <script src="script.js"></script>
                </body>
            </div>
        </div>
    </div>
    

    </div>
</div>
