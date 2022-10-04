<!DOCTYPE html>
    <head>
        <title>To-Do List </title>
        <link rel='stylesheet' href='style/main.css'>
    </head>

    <body>    
        <?php
        //Connect MySQL
        require 'db/db_connect.php'; ?>

        <div class='content'>
            <div class='add-task'>
            <form action="src/new.php" method="POST" autocomplete="off">
                <?php 
                    if(isset($_GET['mess']) && $_GET['mess'] == 'error'){ ?>
                        <input type='text'
                            name='title'
                            placeholder='Field required'/>
                        <button type='submit'>Add</button>
                <?php } 
                    else { ?>

                        <input type="text" 
                                name="title" 
                                placeholder="What do you need to do?" />
                        <button type="submit">Add</button>
                <?php } ?>    
            </form>

            </div>
                <?php 
                    $task = $conn->query("SELECT * FROM task ORDER BY id DESC");
                ?>
            <div class='show-tasks'>
                <?php if($task->rowCount() <= 0) { ?>            
                    <div class='task-item'>
                        <div class='empty'>
                            <img src='assets/notepad-colors.jpg' width="90%"/>
                        </div>
                    </div>
                <?php } ?>

                <?php 
                    while($tasks = $task->fetch(PDO::FETCH_ASSOC)) {?>
                        <div class='task-item'>
                            <span id='
                                <?php 
                                    echo $tasks['id']; ?>'
                                 class='delete-task'>X
                            </span>
                                <?php 
                                    if($tasks['checked']){ ?> 
                                    <input type="checkbox"
                                        class="check-box"
                                        data-todo-id ="
                                            <?php 
                                            echo $tasks['id']; ?>"
                                        checked />
                                    <h2 class="checked">
                                            <?php 
                                            echo $tasks['title'] ?>
                                        </h2>
                                <?php }
                                else { ?>
                                    <input type="checkbox"
                                        data-todo-id ="
                                            <?php 
                                            echo $tasks['id']; ?>"
                                        class="check-box" />
                                    <h2>
                                            <?php 
                                            echo $tasks['title'] ?>
                                            </h2>
                                <?php } ?>
                        <small>
                            Created at: 
                            <?php 
                            echo $tasks['date_time'] ?>
                        </small>
                </div>

                <?php } ?>

            </div>

            <div class='printButton'>
                    <a href='src/generate-pdf.php'>
                        <button class='pdf'>Generate Report
                        </button>
                    </a>
            </div>
        </div>

        <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
        <script src="js/script.js"></script>

    </body>


</html>