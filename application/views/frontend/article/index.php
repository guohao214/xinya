<script type="text/javascript" src="<?php echo get_instance()->config->base_url(); ?>static/frontend/js/move.js?v=201601031111003"></script>
<header>
    <h2><?php echo $article['title']; ?></h2>
</header>

<section>
    <div class="result-wrap1">
        <div class="result-content1">
            <?php echo $article['content']; ?>
        </div>
    </div>
</section>

<style>

    .result-wrap1 {
        width: 100% !important;
        padding: 20px 0px;
    }
    .result-content1 {
        width: 80% !important;
        margin:0px auto !important;
    }

    .result-content1 img {
        text-align: center;
        width: 100%;
        border-radius: 6px;;
    }
</style>

<script>
    $(document).ready(function() {
        move('.result-content1').rotate(-360).end();
    })
</script>