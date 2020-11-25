@if(session("alert"))
<div class="text-center alert alert-{{session("alert")["type"]}}">
    {{session("alert")["message"]}}
</div>
@endif
