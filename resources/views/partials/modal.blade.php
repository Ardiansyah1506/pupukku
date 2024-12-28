@if(session('success'))
<div id="successPopup" class="popup">
    <div class="popup-content">
        <span class="popup-icon">✔</span>
        <h2>SUCCESS!</h2>
        <p>{{ session('success') }}</p>
        <button id="continueButton" type="button">Continue</button>
    </div>
</div>
@endif
@if(session('warning'))
<div id="successPopup" class="popup">
    <div class="popup-content">
        <span class="popup-icon">!</span>
        <h2>Warning</h2>
        <p>{{ session('warning') }}</p>
        <button id="continueButton" type="button">Continue</button>
    </div>
</div>
@endif
