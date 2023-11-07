function convertBase64x(input) {
    var reader = new FileReader();
    reader.onload = function(){
      reader.readAsDataURL(input);
      var dataURL = reader.result;
      console.log(dataURL);
      return output;
    };
  }
  
  const convertBase64 = (file) => {
    return new Promise((resolve, reject) => {
      const fileReader = new FileReader();
      fileReader.readAsDataURL(file);
  
      fileReader.onload = () => {
        resolve(fileReader.result);
      };
  
      fileReader.onerror = (error) => {
        reject(error);
      };
    });
  };
  
  async function toBase64(event) {
    const file = event.target.files[0];
    const base64 = await convertBase64(file); 
    return base64;
  }
  
  
  // const uploadImage = async (event) => {
  //   const file = event.target.files[0];
  //   console.log(file);
  
  //   const base64 = await convertBase64(file);
  
  //   $(event.target).closest('div.box-upload').find('.base64_string').val(base64);
  //   $(event.target).closest('div.box-upload').find('.base64_img').attr('src',base64);
  //   $(event.target).closest('div.box-upload').find('.base64_filesize').html('<b>Size</b> '+ (file.size/1000).toFixed(2) + 'KB');
  //   $(event.target).closest('div.box-upload').find('.base64_filetype').html('<b>Filetype</b> '+file.type);
  //   $(event.target).closest('div.box-upload').find('.base64_filetype').append('<button class="mt-4 btn-block btn btn-xs btn-outline-danger btn-delete-image"><i class="far fa-trash-alt"></i> Remove</button>');
  
  
  // };
  
  const getBase64FromUrl = async (url, input) => {
    const data = await fetch(url);
    const blob = await data.blob();
    return new Promise((resolve) => {
      const reader = new FileReader();
      reader.readAsDataURL(blob); 
      reader.onloadend = () => {
        const base64data = reader.result;  
        input.val(base64data); 
        resolve(base64data);
      }
    });
  }
  
  
  