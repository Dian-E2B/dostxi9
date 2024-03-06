<!DOCTYPE html>
<html lang="en">

<head>
	 <title>DOST XI</title>
	 @vite(['resources/css/app.css', 'resources/js/app.js'])
	 <style>
       .noborder-bottom {
           border-bottom: none !important;
           border-top: none !important;
           border-right-width: medium !important;
					 border-right-color: black !important;
       }

			 .changebordercolor {
           border-right-color: black !important;
					 border-bottom-color: black !important;
			 }

			 .form-check-input {
           border:solid #4c4c4c !important;
			 }

	 </style>
</head>

<body data-theme="light" data-layout="fluid" data-sidebar-position="left" data-sidebar-layout="default">


<script>
    // Declare the canvas variable in a broader scope
    let canvas;

    async function removeImageBackground(imageURL) {
        const backgroundColor = { red: 255, green: 255, blue: 255 };
        const threshold = 10;

        const imageElement = new Image();
        imageElement.src = imageURL;
        await new Promise(function(resolve) { imageElement.addEventListener('load', resolve); });

        var canvas = document.createElement('canvas');
        canvas.width = imageElement.naturalWidth;
        canvas.height = imageElement.naturalHeight;

        var ctx = canvas.getContext('2d');
        ctx.drawImage(imageElement, 0, 0);
        const imageData = ctx.getImageData(0, 0, canvas.width, canvas.height);
        for (var i = 0; i < imageData.data.length; i += 4) {
            const red = imageData.data[i];
            const green = imageData.data[i + 1];
            const blue = imageData.data[i + 2];
            if (Math.abs(red - backgroundColor.red) < threshold &&
                Math.abs(green - backgroundColor.green) < threshold &&
                Math.abs(blue - backgroundColor.blue) < threshold) {
                imageData.data[i + 3] = 0;
            }
        }

        ctx.putImageData(imageData, 0, 0);
        return canvas.toDataURL(`image/png`);

        // Return the resulting image as a data URL (PNG format)

    }

    // Function to handle file upload
    // Function to handle file upload
    function handleFileUpload() {
        const fileInput = document.getElementById('fileInput');
        if (fileInput.files.length === 0) {
            alert('Please select an image file.');
            return;
        }

        const uploadedImage = fileInput.files[0]; // Represents the uploaded image file
        const imageURL = URL.createObjectURL(uploadedImage); // Convert the file to a URL

        // Create an image element for resizing
        const imgForResizing = new Image();
        imgForResizing.src = imageURL;

        imgForResizing.onload = () => {
            const maxWidth = 800; // Specify the maximum width for resizing
            const maxHeight = 800; // Specify the maximum height for resizing
            const ratio = Math.min(maxWidth / imgForResizing.width, maxHeight / imgForResizing.height);

            // Create a canvas element for resizing
            canvas = document.createElement('canvas');
            const ctx = canvas.getContext('2d');
            canvas.width = imgForResizing.width * ratio;
            canvas.height = imgForResizing.height * ratio;
            ctx.drawImage(imgForResizing, 0, 0, canvas.width, canvas.height);

            // Continue with the rest of the code

            removeImageBackground(canvas.toDataURL('image/png'))
                .then(dataURL => {
                    // Create a modified image element
                    const imgElement = document.createElement('img');
                    imgElement.src = dataURL;

                    // Create a download link for the modified image
                    const downloadLink = document.createElement('a');
                    downloadLink.href = dataURL;
                    downloadLink.download = 'modified_image.png'; // Specify the filename for download
                    downloadLink.textContent = 'Download Modified Image';

                    // Append the modified image and download link to the page
                    document.body.appendChild(imgElement);
                    document.body.appendChild(downloadLink);
                });
        };
    }
</script>

{{--<div class="wrapper">--}}




{{--	 <div class="main">--}}
{{--			--}}{{-- HEADER START --}}
{{--			@include('student.layoutsst.header')--}}
{{--			--}}{{-- HEADER END --}}

{{--			<main class="content">--}}
{{--				 <div class="container-fluid p-0">--}}

{{--						<h1 class="h3 mb-3">REQUEST FOR SCHOLARSHIP CLEARANCE</h1>--}}


{{--						<div class="col-xl-12">--}}
{{--							 <div class="card">--}}
{{--									<table class="table table-based">--}}
{{--										 <thead>--}}

{{--										 <tr style="">--}}
{{--												<th style="">Please check the needed documents</th>--}}
{{--												<th style="">Requirements</th>--}}
{{--										 </tr>--}}
{{--										 </thead>--}}
{{--										 <tbody>--}}
{{--										 <tr>--}}
{{--												<td class="noborder-bottom">For NBI – Clearance for local employment</td>--}}
{{--												<td class="changebordercolor"><label class="form-check  ">--}}
{{--															<input class="form-check-input" type="checkbox" value="">--}}
{{--															<span class="form-check-label">Transcript of Records or True Copy of Grades or diploma for scholar-graduate; or</span>--}}
{{--													 </label></td>--}}
{{--										 </tr>--}}
{{--										 <tr>--}}
{{--												<td class="noborder-bottom"></td>--}}
{{--												<td class="changebordercolor"><label class="form-check">--}}
{{--															<input class="form-check-input" type="checkbox" value="">--}}
{{--															<span class="form-check-label">Registration form for OJT/SIT certification from school for on-going scholar</span>--}}
{{--													 </label></td>--}}
{{--										 </tr>--}}
{{--										 <tr>--}}
{{--												<td style="border-right-width: medium;" class="changebordercolor"></td>--}}
{{--												<td class="changebordercolor"><label class="form-check">--}}
{{--															<input class="form-check-input" type="checkbox" value="">--}}
{{--															<span class="form-check-label">Transcript of Records or True Copy of Grades for NON-Compliance scholar</span>--}}
{{--													 </label></td>--}}
{{--										 </tr>--}}
{{--										 --}}{{--END FIRST SECTION--}}
{{--										 <tr>--}}
{{--												<td style="border-right-width: medium;" class="noborder-bottom"> For NBI – Clearance for--}}
{{--													 application for passport--}}
{{--												</td>--}}
{{--												<td class="changebordercolor"><label class="form-check">--}}
{{--															<input class="form-check-input" type="checkbox" value="">--}}
{{--															<span class="form-check-label"> Guaranty letter or</span>--}}
{{--													 </label></td>--}}
{{--										 </tr>--}}
{{--										 <tr>--}}
{{--												<td style="border-right-width: medium;" class="noborder-bottom">For DFA – Passport</td>--}}
{{--												<td class="changebordercolor"><label class="form-check">--}}
{{--															<input class="form-check-input" type="checkbox" value="">--}}
{{--															<span class="form-check-label"> Deed of Undertaking* or</span>--}}
{{--													 </label></td>--}}
{{--										 </tr>--}}
{{--										 <tr>--}}
{{--												<td style="border-right-width: medium;" class="noborder-bottom">For BI – Travel Order</td>--}}
{{--												<td class="changebordercolor"><label class="form-check">--}}
{{--															<input class="form-check-input" type="checkbox" value="">--}}
{{--															<span class="form-check-label">  Official Receipt of cash bond posted or</span>--}}
{{--													 </label></td>--}}
{{--										 </tr>--}}
{{--										 <tr>--}}
{{--												<td style="border-right-width: medium;" class="changebordercolor"></td>--}}
{{--												<td class="changebordercolor"><label class="form-check">--}}
{{--															<input class="form-check-input" type="checkbox" value="">--}}
{{--															<span class="form-check-label">  Original copy of GSIS Surety Bond* Photocopy of I.D. and ITR or Certificate of Employment of co-maker</span>--}}
{{--													 </label></td>--}}
{{--										 </tr>--}}
{{--										 --}}{{--END SECOND SECTION--}}
{{--										 <tr>--}}
{{--												<td style="border-right-width: medium;" class="noborder-bottom">Final clearance</td>--}}
{{--												<td class="changebordercolor"><label class="form-check">--}}
{{--															<input class="form-check-input" type="checkbox" value="">--}}
{{--															<span class="form-check-label"> Certificate/s of Employment/Service Record or</span>--}}
{{--													 </label></td>--}}
{{--										 </tr>--}}
{{--										 <tr>--}}
{{--												<td style="border-right-width: medium; " class="changebordercolor" ></td>--}}
{{--												<td class="changebordercolor"><label class="form-check">--}}
{{--															<input class="form-check-input" type="checkbox" value="">--}}
{{--															<span class="form-check-label"> Official Receipt of refund of scholarship benefits received--}}
{{--</span>--}}
{{--													 </label></td>--}}
{{--										 </tr>--}}
{{--										 --}}{{--END THIRD SECTION--}}
{{--										 <tr>--}}
{{--												<td style="border-right-width: medium;" class="noborder-bottom">Computation of scholarship benefits received </td>--}}
{{--												<td class="changebordercolor"><label class="form-check">--}}
{{--															<input class="form-check-input" type="checkbox" value="">--}}
{{--															<span class="form-check-label"> Transcript of Records or True Copy of Grades and/or</span>--}}
{{--													 </label></td>--}}
{{--										 </tr>--}}
{{--										 <tr>--}}
{{--												<td style="border-right-width: medium;" class="changebordercolor" > </td>--}}
{{--												<td class="changebordercolor"><label class="form-check">--}}
{{--															<input class="form-check-input" type="checkbox" value="">--}}
{{--															<span class="form-check-label"> Certificate of Employment</span>--}}
{{--													 </label></td>--}}
{{--										 </tr>--}}
{{--										 --}}{{--END FOURTH SECTION--}}
{{--										 <tr>--}}
{{--												<td style="border-right-width: medium; " class="changebordercolor" >Others (Please specify)</td>--}}
{{--												<td class="changebordercolor"></td>--}}
{{--										 </tr>--}}
{{--										 </tbody>--}}

{{--									</table>--}}
{{--							 </div>--}}
{{--						</div>--}}


{{--				 </div>--}}
{{--			</main>--}}

{{--	 </div>--}}
{{--</div>--}}

			<input type="file" id="fileInput" accept="image/*">
			<button onclick="handleFileUpload()">Remove Background</button>
</body>
{{-- PRINT TOGGLING --}}


</html>
