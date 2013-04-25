<div id="infoline">
	<div class="infoline-error" style="display:<?php echo $this->session->userdata('error') ? '': 'none'?>"> 
		<?php 
			if ($this->session->userdata('error'))
			{
				echo $this->session->userdata('error');
				$this->session->unset_userdata('error');
			}
		?>
	</div>
	<div class="infoline-warning" style="display:<?php echo $this->session->userdata('warning') ? '': 'none'?>">
		<?php 
			if ($this->session->userdata('warning'))
			{
				echo $this->session->userdata('warning');
				$this->session->unset_userdata('warning');
			}
		?>
	</div>
	<div class="infoline-info" style="display:<?php echo $this->session->userdata('info') ? '': 'none'?>">
		<?php 
			if ($this->session->userdata('info'))
			{
				echo $this->session->userdata('info');
				$this->session->unset_userdata('info');
			}
		?>
	</div>
</div>