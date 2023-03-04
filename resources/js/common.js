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

window.copyText = copyText;