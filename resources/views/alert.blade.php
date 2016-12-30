@if (notify()->ready())
	<script>
		Messenger().post({
			message: '{{ notify()->message() }}',
	    	type: '{{ notify()->type() }}',
	    	showCloseButton: true
		})
    </script>
@endif