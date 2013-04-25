<?php

/**
 * This controller is responsible for handling uploads. 
 */
class Files extends MY_Controller 
{
	
	public function crop($input_name = 'image_url')
	{
		try
		{
	
			// Get crop details
			$url = realpath(APPPATH.'../images/'.$this->input->post($input_name));
			$x = $this->input->post('x');
			$y = $this->input->post('y');
			$w = $this->input->post('w');
			$h = $this->input->post('h');
			$s = $this->input->post('s');
			
			if ($w != '')
			{
				
				// Get image files
				$info = GetImageSize($url);
				
				if(empty($info))
				{
					throw new Exception("<p> The file '".$url."' doesn't seem to be an image. </p>");
				}
				
				$mime = $info['mime'];
				
				$type = substr(strrchr($mime, '/'), 1);
				
				$use_this = false;
				
				switch ($type)
				{
					case 'jpeg':
						$image_create_func = 'ImageCreateFromJPEG';
						$image_save_func = 'ImageJPEG';
						$new_image_ext = 'jpg';
						break;
				 
					case 'png':
						$image_create_func = 'ImageCreateFromPNG';
						$image_save_func = 'ImagePNG';
						$new_image_ext = 'png';
						break;

					case 'bmp':
					case 'x-ms-bmp':
						$use_this = true;
						$image_create_func = 'ImageCreateFromBMP';
						$image_save_func = 'ImageBMP';
						$new_image_ext = 'bmp';
						break;
				 
					case 'gif':
						$image_create_func = 'ImageCreateFromGIF';
						$image_save_func = 'ImageGIF';
						$new_image_ext = 'gif';
						break;
					 
					case 'vnd.wap.wbmp':
						$image_create_func = 'ImageCreateFromWBMP';
						$image_save_func = 'ImageWBMP';
						$new_image_ext = 'bmp';
						break;

					case 'xbm':
						$image_create_func = 'ImageCreateFromXBM';
						$image_save_func = 'ImageXBM';
						$new_image_ext = 'xbm';
						break;
					 
					default:
						$image_create_func = 'ImageCreateFromJPEG';
						$image_save_func = 'ImageJPEG';
						$new_image_ext = 'jpg';
						
				}
				
				if ($use_this)
				{
					$original_image = $this->$image_create_func($url);
				}
				else
				{
					$original_image = $image_create_func($url);
				}
				
				$original_width = $info[0];
				$original_height = $info[1];
				
				$new_image = ImageCreateTrueColor($w, $h);
				
				// Fill transparent areas with white
				$white_color = imagecolorallocate($new_image, 255, 255, 255); 
				imagefill($new_image, 0, 0, $white_color); 
				
				// Copy from source file
				ImageCopyResampled($new_image, $original_image, 0, 0, $x / $s, $y / $s, $w, $h, $w / $s, $h / $s);
				
				
				if (!$image_save_func($new_image, $url))
				{
					throw new Exception("<p> Unable to save image. </p>");
				}
				
				echo '{ "success": true, "message": "image cropped succesfully." }';
				
			}
			else
			{
				echo '{ "success": true, "message": "image set succesfully (no crop)." }';
			}
			
		}
		catch (Exception $e)
		{
		
			// Rollback transaction
			$this->db->trans_rollback();
	
			echo '{ "success": false, "message": "'.$e->getMessage().'" }';
		
		}
	}
	
	public function upload()
	{
		try
		{
	
			// Get remote ip address
			$ip_address = $_SERVER['REMOTE_ADDR'];
		
			// Construct file name
			$file_name = str_replace('.', '_', $ip_address);
		
			// Configure upload parameters
			$config['upload_path'] = realpath(APPPATH . '../images/temp');
			$config['file_name'] = $file_name;
			$config['overwrite'] = true;
			$config['allowed_types'] = $this->get('image_types');
			$config['max_size']	= $this->get('max_image_size');
			$config['max_width']  = $this->get('max_image_width');
			$config['max_height']  = $this->get('max_image_height');
			
			// load library
			$this->load->library('upload', $config);

			// Upload file
			if (!$this->upload->do_upload('file'))
			{
				throw new Exception('<p> inner '.$this->upload->display_errors().'</p>');
			}
		
			// Load temp_images model
			$this->load->model('temp_images_model');
		
			// Get exact file name
			$file_data = $this->upload->data();
			$file_name = 'temp/'.$file_data['file_name'];
		
			// Return file name
			echo '{ "success": true, "temp_image_url":"'.str_replace('/', '//', $file_name).'", "message": "success" }';
			
			return $file_name;
				
		}
		catch (Exception $e)
		{
		
			// Rollback transaction
			$this->db->trans_rollback();
	
			echo '{ "success": false, "message": "'.$e->getMessage().'" }';
		
		}
	}
	
	function imagebmp(&$img, $filename = false)
	{
		$wid = imagesx($img);
		$hei = imagesy($img);
		$wid_pad = str_pad('', $wid % 4, "\0");
		
		$size = 54 + ($wid + $wid_pad) * $hei;
		
		//prepare & save header
		$header['identifier']		= 'BM';
		$header['file_size']		= dword($size);
		$header['reserved']			= dword(0);
		$header['bitmap_data']		= dword(54);
		$header['header_size']		= dword(40);
		$header['width']			= dword($wid);
		$header['height']			= dword($hei);
		$header['planes']			= word(1);
		$header['bits_per_pixel']	= word(24);
		$header['compression']		= dword(0);
		$header['data_size']		= dword(0);
		$header['h_resolution']		= dword(0);
		$header['v_resolution']		= dword(0);
		$header['colors']			= dword(0);
		$header['important_colors']	= dword(0);

		if ($filename)
		{
			$f = fopen($filename, "wb");
			foreach ($header AS $h)
			{
				fwrite($f, $h);
			}
			
			//save pixels
			for ($y=$hei-1; $y>=0; $y--)
			{
				for ($x=0; $x<$wid; $x++)
				{
					$rgb = imagecolorat($img, $x, $y);
					fwrite($f, byte3($rgb));
				}
				fwrite($f, $wid_pad);
			}
			fclose($f);
		}
		else
		{
			foreach ($header AS $h)
			{
				echo $h;
			}
			
			//save pixels
			for ($y=$hei-1; $y>=0; $y--)
			{
				for ($x=0; $x<$wid; $x++)
				{
					$rgb = imagecolorat($img, $x, $y);
					echo byte3($rgb);
				}
				echo $wid_pad;
			}
		}
	}

	function imagecreatefrombmp($filename)
	{
		$f = fopen($filename, "rb");

		//read header    
		$header = fread($f, 54);
		$header = unpack(	'c2identifier/Vfile_size/Vreserved/Vbitmap_data/Vheader_size/' .
							'Vwidth/Vheight/vplanes/vbits_per_pixel/Vcompression/Vdata_size/'.
							'Vh_resolution/Vv_resolution/Vcolors/Vimportant_colors', $header);

		if ($header['identifier1'] != 66 or $header['identifier2'] != 77)
		{
			throw new Exception('Not a valid bmp file');
		}
		
		if ($header['bits_per_pixel'] != 24)
		{
			throw new Exception('Only 24bit BMP images are supported');
		}
		
		$wid2 = ceil((3*$header['width']) / 4) * 4;
		
		$wid = $header['width'];
		$hei = $header['height'];

		$img = imagecreatetruecolor($header['width'], $header['height']);

		//read pixels    
		for ($y=$hei-1; $y>=0; $y--)
		{
			$row = fread($f, $wid2);
			$pixels = str_split($row, 3);
			for ($x=0; $x<$wid; $x++)
			{
				imagesetpixel($img, $x, $y, dwordize($pixels[$x]));
			}
		}
		fclose($f);    	    
		
		return $img;
	}	

	function dwordize($str)
	{
		$a = ord($str[0]);
		$b = ord($str[1]);
		$c = ord($str[2]);
		return $c*256*256 + $b*256 + $a;
	}

	function byte3($n)
	{
		return chr($n & 255) . chr(($n >> 8) & 255) . chr(($n >> 16) & 255);	
	}
	
	function dword($n)
	{
		return pack("V", $n);
	}
	
	function word($n)
	{
		return pack("v", $n);
	}
	
}