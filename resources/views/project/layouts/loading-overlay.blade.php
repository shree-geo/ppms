<script type="text/javascript">
function overlayOn(overlay_id='loader') {
  document.getElementById(overlay_id).style.display = "block";
}

function overlayOff(overlay_id='loader') {
  document.getElementById(overlay_id).style.display = "none";
}
</script>
<style type="text/css">
    #loader {
        border: 10px solid #f3f3f3; 
        border-top: 12px solid #3498db; 
        border-bottom: 12px solid #3498db;
        border-radius: 50%;
        width: 100px;
        height: 100px;
        animation: spin 2s linear infinite;
         display: flex;
    }
    @keyframes spin {
  0% { transform: rotate(0deg); }
  100% { transform: rotate(360deg); }
}
.center {
 text-align: center
}
</style>
