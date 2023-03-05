// 텍스트 복사
async function copyText(text) {
    try {
        // writeText가 비동기식이므로 await처리 필요
        await navigator.clipboard.writeText(text);
        alert("URL을 저장했습니다");
    } catch (err) {
        calert("URL 복사중 에러가 발생했습니다");
    }
}

// 파일등록시 임시이미지 생성
function createTempImage() {
    let fileTag = event.target;

    if(fileTag.files[0]){
        const imageTag = document.querySelector('#tempImg');

        // 파일객체를 넣고 blob으로 생성되는 URL생성 (<img src="blob:http%..)
        imageTag.src = window.URL.createObjectURL(fileTag.files[0]);//img src에 blob주소 변환

        imageTag.onload = () => {
          window.URL.revokeObjectURL(imageTag.src)  //나중에 반드시 해제해주어야 메모리 누수가 안생김.
        }
      }
}

window.copyText = copyText;
window.createTempImage = createTempImage;