{*include file = 'common/header.tpl'*}
<div>Debug Hayashi</div>

{*test_user*}
{if isset($testUser){
    true
    <br/>
    {$testUser.VALUE001}
{else}
     false
{/if}
<br/>

{if isset($person)}
<ul>
    {forreach from=$person item="value" key="key" name="person"}
    <li>{$key} : {$value}</li>
    {/forreach}
</ul>
{count($person)}
{/if}
<br/>

<a href="{"&amp;c=DebugHayasahi"|url}">this page</a>
<br/>
<a href="{"$amp;c=DubugHayashi;f=part"|url}">parts</a>
<br/>
{inclue file='debug/DebugHayashi/part.tpl'}
