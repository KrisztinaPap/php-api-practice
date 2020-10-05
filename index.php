<?php
include './templates/header.php';

?>

<h1>Krisztina's PHP API Practice</h1>

<div class="content-area">

<h2>Open Skills API - Job titles</h2>

<form action="#" method="GET">
    <label for="keyword">Enter a keyword:
        <input type="text" id="keyword" name="keyword">
    </label>
    <input type="submit" value="Search">
</form>

<ul>
    <?php
    // @link https://github.com/workforce-data-initiative/skills-api/wiki/API-Overview
    $skillsAPIResponse = file_get_contents( "http://api.dataatwork.org/v1/jobs/autocomplete?contains={$_GET['keyword']}" );

    if ( $skillsAPIResponse )
    {
        $skillsData = json_decode( $skillsAPIResponse );
        if ( $skillsData )
        {
            foreach ( $skillsData as $skill )
            {
                if ( isset($skill->normalized_job_title) )
                {
                ?>
                    <li>
                        <?php echo $skill->normalized_job_title; ?>
                    </li>
                <?php
                }  
            }
        }
        else
        {
            echo "ERROR: Unable to convert API response to PHP.";
        }
    } 
    else
    {
        echo "ERROR: Unable to get API response.";
    }

    ?>
</ul>
</div>
<?php
    include './templates/footer.php';
?>