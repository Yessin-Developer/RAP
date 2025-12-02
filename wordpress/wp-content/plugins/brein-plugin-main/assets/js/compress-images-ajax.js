jQuery(document).ready(function ($) {
  console.log('compress-images-ajax.js loaded');
  $('#start-compression').on('click', function () {
    $('#compression-progress').html('<p>Starting compression...</p>');
    processBatch(0);
  });

  function processBatch(batch) {
    $.ajax({
      url: compressImagesData.ajaxUrl,
      type: 'POST',
      dataType: 'json',
      data: {
        action: 'compress_images_ajax',
        nonce: compressImagesData.nonce,
        batch: batch
      },
      success: function (response) {
        if (response.status === 'processing') {
          $('#compression-progress').append('<p>' + response.message + '</p>');
          // Process the next batch after a short delay.
          setTimeout(function () {
            processBatch(response.batch);
          }, 1000);
        } else if (response.status === 'completed') {
          $('#compression-progress').append('<p>' + response.message + '</p>');
        }
      },
      error: function () {
        $('#compression-progress').append('<p>Error processing batch.</p>');
      }
    });
  }
});
