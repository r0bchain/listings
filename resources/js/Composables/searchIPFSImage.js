
import {computed, ref} from 'vue'
import { createClient } from 'pexels';
import { PinataSDK } from "pinata-web3";

export const searchIPFSImage = async (topic, PINATA_SECRET_JWT, PINATA_GATEWAY) => {

    const pinata = new PinataSDK({
        pinataJwt: PINATA_SECRET_JWT,
        pinataGateway: PINATA_GATEWAY,
    });
    
    const files = await pinata
    .listFiles()
    .keyValues('category', topic, 'like')
    .then((response) => {
        console.log(response.rows);
        return response.rows;
    
    })

}