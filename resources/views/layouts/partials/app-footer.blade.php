<!-- Footer -->
<footer class="Footer">
    <div class="copyright">
        <p>&copy; {{ date('Y') }} Rebuy. All rights reserved.</p>
    </div>
    <div class="brand">
        <p>&gt; Rebuy &lt;</p>
    </div>
</footer>
<!-- Side utilities -->
<aside class="Utilities">
    <div class="unit back-top" :class="{ 'hide' : !displayBackTop}" @click="backToTop">
        <i class="fa fa-angle-up"></i>
    </div>
</aside>
@stack('footer')