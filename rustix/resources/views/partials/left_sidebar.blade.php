
<section class="d-flex">
    @include('partials.left_sidebar.alt')
    @include('partials.left_sidebar.faq')
    @include('partials.left_sidebar.tos')

    <div class="d-flex flex-column">
        
        <button>TOS</button>
        <button>FAQ</button>
        <button>ALT</button>
        
        <button><i class="fas fa-arrow-left mb15"></i></button>
    </div>
    @include('partials.left_sidebar.chat')
</section>
