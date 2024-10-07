
import { PinataSDK } from "pinata-web3";

export const searchIPFSImage = async (topic, PINATA_SECRET_JWT, PINATA_GATEWAY) => {
    const pinata = new PinataSDK({
        pinataJwt: PINATA_SECRET_JWT,
        pinataGateway: PINATA_GATEWAY, // https://ipfs.io/ipfs/
    });
    
   // console.log('PINATA_SECRET_JWT', PINATA_SECRET_JWT);
    console.log('topic', topic);

    const images = {
        'Phi Phi'         : 'QmekUWbmguH8zNwP1yk3Ep4yWQC6CuekK43oBAh8RGbsVb',
        'Krabi'           : 'QmSJSydbc8CHwMiSP753PGsUMeRuWdtyvKg8ucCiFTfeBD',
        'Koh Maak'        : 'QmNtFNPgTXZK42sWATrEezTwRSvnj2YzKDtbuzY7jgdwis',
        'Koh Phangan'     : 'QmTggrY1HACBohqyzkZ4C8th88oQ2C9SKXkgzjDoZFsLKe',
        'Koh Samui'       : 'QmNQiSMbhW1yThuJTWuQ1pYXpTSyyA14YiHkgj2wp1pK1L',
        'Hua Hin'         : 'Qmb19PUbQaMFEDuYb2Feudo6QGMkK3xiuBvHfgjYdBQBn6',
        'Ayutaya'         : 'QmZutPZ95NMM3zJvfhNYMXNhA3VeUG2omRKZpsKkmYyr2W',
        'Phuket'          : 'QmZVxYJaGQ7ZFZ66mZ5DBDuxJtzGuaRgtuEYhTDJ4YzyRs',
        'Buddha Thailand' : 'QmZF9YGN3HbWwGzk9fPKgQiLFF8H8WY5e4abFRSUpxtyqa',
        'Pattaya'         : 'QmQRsYBxh7TTKePWtw5ZVBqxtKLFoFKsAdsTco4LjskwJ4',
        'Bangkok'         : 'QmWG7sbksCUmADPSWre6kbnK8BBoSDVyhhCMviGURUsKog',
        'Chiang Mai'      : 'QmdDp3cSZh1gTMXRrtxFYXm9DTay821JBEbx6e5VN6quWo',
        

    };
   
    if(images[topic]) {
        return `https://${PINATA_GATEWAY}/ipfs/${images[topic]}`;
    }  

    // Default image
    return 'https://cyan-acceptable-bovid-702.mypinata.cloud/ipfs/QmekUWbmguH8zNwP1yk3Ep4yWQC6CuekK43oBAh8RGbsVb';


//     const response = await pinata
//     .listFiles()
//     .name(topic);
//    // .keyValue("city", "thailand", "eq")
//         // console.log('response', response);
//     if(response.length === 0) {
//         return 'https://cyan-acceptable-bovid-702.mypinata.cloud/ipfs/QmfJqMfkoWotjxW86C5zA4e1HgnB5MaAdBXwg4fsAzLzwz';
//     }
//     const randomImage =  response[0]; //response.rows;
//     const endpoint = `https://${PINATA_GATEWAY}/ipfs/${randomImage['ipfs_pin_hash']}`;
//     // console.log(endpoint);

//     return endpoint;
       
  

}