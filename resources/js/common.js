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

    if (fileTag.files[0]) {
        const imageTag = document.querySelector("#tempImg");

        // 파일객체를 넣고 blob으로 생성되는 URL생성 (<img src="blob:http%..)
        imageTag.src = window.URL.createObjectURL(fileTag.files[0]); //img src에 blob주소 변환

        imageTag.onload = () => {
            window.URL.revokeObjectURL(imageTag.src); //나중에 반드시 해제해주어야 메모리 누수가 안생김.
        };
    }
}

// 파일다운로드
async function downloadFile(url, filename) {
    const response = await fetch(url);
    const file = await response.blob();
    const downloadUrl = window.URL.createObjectURL(file); // 해당 file을 가리키는 url 생성

    const anchorElement = document.createElement("a");
    document.body.appendChild(anchorElement);
    anchorElement.download = filename; // a tag에 download 속성을 줘서 클릭할 때 다운로드가 일어날 수 있도록 하기
    anchorElement.href = downloadUrl; // href에 url 달아주기

    anchorElement.click(); // 코드 상으로 클릭을 해줘서 다운로드를 트리거

    document.body.removeChild(anchorElement); // cleanup - 쓰임을 다한 a 태그 삭제
    window.URL.revokeObjectURL(downloadUrl); // cleanup - 쓰임을 다한 url 객체 삭제
}

window.copyText = copyText;
window.createTempImage = createTempImage;
window.downloadFile = downloadFile;
