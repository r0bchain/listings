
import { PinataSDK } from "pinata-web3";

export const searchIPFSImage = async (topic, PINATA_SECRET_JWT, PINATA_GATEWAY) => {
    const pinata = new PinataSDK({
        pinataJwt: PINATA_SECRET_JWT,
        pinataGateway: PINATA_GATEWAY, // https://ipfs.io/ipfs/
    });
    
   // console.log('PINATA_SECRET_JWT', PINATA_SECRET_JWT);
    console.log('topic', topic);

    await pinata
    .listFiles()
    .name('Thailand')
   // .keyValue("city", "thailand", "eq")
    .then( (response) => {
        // console.log('response', response);
        const randomImage =  response[0]; //response.rows;
        console.log(`https://${PINATA_GATEWAY}/ipfs/${randomImage['ipfs_pin_hash']}`);

        return `https://${PINATA_GATEWAY}/ipfs/${randomImage['ipfs_pin_hash']}`;
       
    
    }).catch((err) => {
        console.log(err);
        return [];
    });

}