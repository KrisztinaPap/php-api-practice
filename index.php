<?php
    // Starts session - so cookies can hold session data
    session_start();
    // If activeList array has not been initialized (new session), initialize both active and completed arrays
    if ( !isset( $_SESSION['activeList'])){
        $_SESSION['activeList'] = array();
        $_SESSION['completedList'] = array();
    }
    $newToDo = '';

    include './templates/header.php';
    include_once './include/validator.php';

    if(isset($_POST['add']))
    {
        if ( ( !empty( $_POST)) && ($_POST['newTask'] !== '' ) && ( !in_array( $_POST['newTask'], $_SESSION['activeList']) ) )
        {
            $newToDo = validate_input($_POST['newTask']);
            array_push( $_SESSION[ 'activeList' ], "{$newToDo}" );
            $newToDo = '';
        }
    }
    if(isset($_POST['reset']))
    {
        session_unset();
        session_destroy();
    }
    // Received advice re: using isset instead of onclick on delete button from Lindsey Graham
    if (isset($_POST['deleteTask'])) {
        // Received guidance from Lindsey Graham but I worked through the below 3 lines of code line-by-line!
        // var_dump(array_keys($_POST['deleteTask'])[0]);
        $deleteId = array_keys($_POST['deleteTask'])[0];
        unset($_SESSION[ 'activeList' ][$deleteId]);
    }
    if (isset($_POST['completeTask'])) {
        $completedId = array_keys($_POST['completeTask'])[0];
        $completedTask = $_SESSION[ 'activeList' ][$completedId];
        array_push( $_SESSION[ 'completedList' ], "{$completedTask}" );
        unset($_SESSION[ 'activeList' ][$completedId]);
    }
?>

<h1>Krisztina's PHP To-Do List</h1>

<section id="addToDoSection">
    <h2>Add a To-Do</h2>
    <form method="POST" action="index.php">
        <div class="flex-container" id="input-container">
            <label for="newTask">
                Enter a new task:
            </label>
            <input 
                id="newTask" 
                name="newTask"
                type="string"
                value="">
            <div class="buttons">
                <button type="btn" name="add" value="Add To List"><i class="far fa-plus-square"></i></button>
                <button type="btn" name="reset" value="Reset List"><i class="fas fa-power-off"></i></button>
            </div>
        </div>
    </form>
</section>

<section id="activeToDoSection">
    <h2>Active To-Dos</h2>
    <ul>
        <?php if ( !empty($_SESSION['activeList']) ) : ?> 
            <!-- Received advice from Lindsey Graham re: adding id to following code line -->
            <?php foreach ( $_SESSION[ 'activeList' ] as $id=>$task ) : ?>
                <li>
                    <form method="POST" action="index.php">
                        <div class="flex-container">
                            <div class="task-name">
                                <?php echo $task ?>
                            </div>
                            <div class="buttons">
                                <!-- Received advice from Lindsey Graham re: how to add id number to following code line (htmlspecialchars) -->
                                <button id="delete-<?php echo $task?>" type="btn" name="deleteTask[<?php echo htmlspecialchars($id); ?>]" value="delete"><i class="fas fa-trash-alt"></i></button>
                                <button id="complete-<?php echo $task?>" type="btn" name="completeTask[<?php echo htmlspecialchars($id); ?>]" value="isCompleted"><i class="far fa-check-square"></i></button>
                            </div>
                        </div>
                    </form>
                </li>
            <?php endforeach; ?>
        <?php endif ?>
    </ul>
</section>

<section id="completedToDoSection">
    <h2>Completed To-Dos</h2>
    <ul>
        <?php if ( !empty($_SESSION['completedList']) ) : ?> 
                <?php foreach ( $_SESSION[ 'completedList' ] as $id=>$task ) : ?>
                    <?php if ( $task !== '') : ?>
                        <li>
                            <?php echo $task ?>
                        </li>
                    <?php endif ?>
                <?php endforeach; ?>
        <?php endif ?>
    </ul>
</section>

<?php
    include './templates/footer.php';
?>