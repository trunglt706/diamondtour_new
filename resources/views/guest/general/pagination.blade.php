<div class="blog-pagination text-center">
    {{ $list->appends(request()->all())->links() }}
</div>
