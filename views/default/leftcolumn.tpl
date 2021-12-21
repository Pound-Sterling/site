<!--  -->
<div class="leftColumn">

    {* <div class="menu__burger-wrapper">
        <div class="menu__burger">
            <span></span>
        </div>
    </div> *}

    <nav id="cssmenu">
        <ul>
            {foreach $rsCategories as $item}
            <li><a href="/?controller=category&id={$item['id']}">{$item['name']}</a>
                {if isset($item['children'])}
                <ul>
                    {foreach $item['children'] as $itemChild}
                    <li><a href="/?controller=category&id={$itemChild['id']}">{$itemChild['name']}</a></li>
                    {/foreach}
                </ul>
            </li>
            {/if}
            {/foreach}
        </ul>
    </nav>
    
</div>