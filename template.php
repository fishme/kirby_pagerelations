<?php
/**
 * template for the page relation field
 *
 * @author David Hohl <david.hohl@gmail.com>
 * @todo remove static translation stuff, clean code and move js to external file
 */


?>
<div class="pagerelation">
    <div class="field-content"><input type="text" class="input" id="searchInavailableList" name="searchword" value="" placeholder="search..." /><div class="field-icon"><i class="icon fa fa-search"></i></div></div>
    <div class="pagerelation_left">
        <h2>Available (<span class="count"></span>)</h2>
        <ul id="availableList" class="connectedSortable">
            <?php
            foreach( $content_pages as $content) {
                echo '<li class="ui-state-default" id="' .$content->uri() . '" title="'.$content->title()->html().'"><i class="icon fa fa-arrows"></i> '. $field->truncate($content->title()->html(),20,'...') . '</li>';
            }
            ?>
        </ul>
    </div>
    <div class="pagerelation_right">
        <h2>Active</h2>
        <ul id="activeList" class="connectedSortable">
            <?php
            if (is_array($field->pr_values) && count($field->pr_values)) {
                foreach($field->pr_values as $item) {
                    $page_item = site()->page($item);
                    if($page_item) {
                        echo '<li class="ui-state-default" id="' .$page_item->uri() . '" title="'.$page_item->title()->html().'"><i class="icon fa fa-arrows"></i> '. $field->truncate($page_item->title()->html(),20,'...') . '</li>';
                    }
                }

            }
            ?>

        </ul>
    </div>
</div>
<script type="text/javascript">

    $(function() {

        $('#searchInavailableList').bind("change keyup", function() {
            searchWord = $(this).val();
            i = 0;
            if (searchWord.length >= 0) {
                $('ul#availableList li').each(function() {
                    text = $(this).text();
                    if (!text.match(RegExp(searchWord, 'i'))) {
                        $(this).hide();
                    } else {
                        $(this).show();
                        i++;
                    }
                });
                $('.pagerelation_left .count').html(i);
            }
        });

        $( "#availableList, #activeList" ).sortable({
            connectWith: ".connectedSortable",
            placeholder: "ui-state-highlight",
            update: function( event, ui ) {
                var items = [];
                $('#activeList li').each(function() {
                    items.push($(this).attr('id'));
                });

                $('#form-field-contents').val(items.join(';'));
            }
        }).disableSelection();


        // clean available list from double items
        $('#activeList li').each(function() {
            $('#availableList li[id="'+$(this).attr('id')+'"]').remove();
        });

        $('.pagerelation_left .count').html($('#availableList li').length);

    });
</script>