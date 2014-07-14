<?php
class Default_View_Helper_PageHelp extends Zend_View_Helper_Action
{
    public function PageHelp($url)
    {
        $html ='
                <div class="modal fade" id="myModal" tabindex="-1" role="dialog"
        	aria-labelledby="myModalLabel" aria-hidden="true">
        	<div class="modal-dialog">
        		<div class="modal-content">
        			<div class="modal-header">
        				<button type="button" class="close" data-dismiss="modal"
        					aria-hidden="true">&times;</button>
        				<h4 class="modal-title" id="myModalLabel">Help - '.$url.'</h4>
        			</div>
        			<div class="modal-body">...</div>
        			<div class="modal-footer">
        				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        			</div>
        		</div>
        		<!-- /.modal-content -->
        	</div>
        	<!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->
                ';
        
        return $html;
    }
}