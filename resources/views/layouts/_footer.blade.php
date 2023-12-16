<footer id="main-footer">
    <div class="container">
        <div class="copyrights">
            {!! __('Copyright &copy; 2023 :name. All rights reserved. Powered by <a href="https://directsoft.ro">DirectSoft Web Design Agency</a>.', ['name' => config('app.name')]) !!}
        </div>
        <div class="support">
            {{ __('Tech support: :email', ['email' => 'office@directsoft.ro']) }}
        </div>
    </div>
</footer>
